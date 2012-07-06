package com.joe.track.android.maps;


import com.google.android.maps.GeoPoint;
import com.google.android.maps.OverlayItem;
import com.joe.track.android.application.ObjectOfInterestList;

public class UserClusterOverlayItem extends OverlayItem {
	ObjectOfInterestList mOOIList;

	public UserClusterOverlayItem(ObjectOfInterestList oois, GeoPoint point) {
		super(point, "Cluster", String.valueOf(oois.size()));
		this.mOOIList = oois;
	}

	public ObjectOfInterestList getObjectOfInterestList() {
		return this.mOOIList;
	}
	

}
