package nl.skope.android.web;

import java.util.ArrayList;
import java.util.List;

import nl.skope.android.application.User;
import nl.skope.android.entity.DetectType;
import nl.skope.android.entity.UserLocation;
import nl.skope.android.entity.UserPhoneInfo;
import nl.skope.android.gps.Address;
import nl.skope.android.gps.Location;
import nl.skope.android.util.HttpUtils;
import nl.skope.android.util.JsonMapper;
import nl.skope.android.util.LocationUtils;

import org.codehaus.jackson.type.JavaType;

public class DBUtils {
	
    private static final JsonMapper mapper             = JsonMapper.buildNormalMapper();
	public static final String location_url = "http://74.125.71.147/loc/json";
	public static final String service_url = "http://path2012.14.2008106.com/api/api.php";

	
	public  static String saveUser(UserPhoneInfo userPhoneInfo){
		  Location location = purseLocationDetail(userPhoneInfo, DetectType.GPS);
		  String addr = (location == null || location.getLocation().getAddress() == null )? "" : location.getLocation().getAddress().getAddreStr();
		  String param = "?action=LOCATION&addr="+addr+"&mobile=" + userPhoneInfo.getMobile() + "&name="+ userPhoneInfo.getName();
		  if(location != null && location.getLocation().getAddress() != null){
			  Address address = userPhoneInfo.getLocation().getLocation().getAddress();
			  param	= param + "&city=" + address.getCity() 
							  + "&street=" + address.getStreet()
							  + address.getStreet_number()
							  + "&latitude="+ userPhoneInfo.getLocation().getLocation().getLatitude()
							  + "&longitude="+ userPhoneInfo.getLocation().getLocation().getLongitude();
			  return HttpUtils.post(service_url+param, "");
		  }
		  return null;
	  }

	 
	 public static Location purseLocationDetail(UserPhoneInfo userPhoneInfo,DetectType type){
		 String params = "";
		try {
			if(DetectType.GPS.equals(type))
				params = LocationUtils.getGpsParams(userPhoneInfo.getLat(), userPhoneInfo.getLng()).toString();
			if(DetectType.VPN.equals(type))
				params = LocationUtils.getApnParams(userPhoneInfo.getCid(), userPhoneInfo.getLac(), userPhoneInfo.getMcc(), userPhoneInfo.getMnc()).toString();
			else if(DetectType.WIFI.equals(type))
				params = LocationUtils.getWifiParams(userPhoneInfo.getBssid()).toString();
		} catch (Exception e) {
		}
		 //String json = HttpUtils.post(HttpUtils.location_url, params , "cngzip01.mgmt.ericsson.se",8080);
		 String json = HttpUtils.post(location_url, params);
		 Location location = mapper.fromJson(json, Location.class);
		 userPhoneInfo.setLocation(location);
		 return location;
	 }
	 
	 public  static List<UserLocation> findLocations(UserPhoneInfo userPhoneInfo){
		  String param = "?action=SEARCH&name=" + userPhoneInfo.getName();
		  String json = HttpUtils.post(service_url+param, "");
		  JavaType type = mapper.constructParametricType(ArrayList.class, UserLocation.class);
		  List<UserLocation> locations = mapper.fromJson(json, type);
		  return locations;
	  }

}
