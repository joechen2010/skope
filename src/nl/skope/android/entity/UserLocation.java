package nl.skope.android.entity;


public class UserLocation {
	
	private Long userid;
	private String name;           
	private String mobile;            
	private String address;             
	private String timestamp;                
	private String city;                 
	private String street;               
	private double latitude;    
	private double longitude;
	
	public String getName() {
		return name;
	}
	public void setName(String name) {
		this.name = name;
	}
	public String getMobile() {
		return mobile;
	}
	public void setMobile(String mobile) {
		this.mobile = mobile;
	}
	public String getAddress() {
		return address;
	}
	public void setAddress(String address) {
		this.address = address;
	}
	public String getTimestamp() {
		return timestamp == null ? "" : timestamp.substring(0,16);
	}
	public void setTimestamp(String timestamp) {
		this.timestamp = timestamp;
	}
	public String getCity() {
		return city;
	}
	public void setCity(String city) {
		this.city = city;
	}
	public String getStreet() {
		return street;
	}
	public void setStreet(String street) {
		this.street = street;
	}
	public double getLatitude() {
		return latitude;
	}
	public void setLatitude(double latitude) {
		this.latitude = latitude;
	}
	public double getLongitude() {
		return longitude;
	}
	public void setLongitude(double longitude) {
		this.longitude = longitude;
	}
	public Long getUserid() {
		return userid;
	}
	public void setUserid(Long userid) {
		this.userid = userid;
	}  
}
