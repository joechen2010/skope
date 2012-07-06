package com.joe.track.android.maps;


import com.google.android.maps.GeoPoint;
import com.google.android.maps.OverlayItem;
import com.joe.track.android.application.User;

public class UserOverlayItem extends OverlayItem {
	User mUser;

	public UserOverlayItem(User user, GeoPoint point) {
		super(point, user.createName(), user.createLabelStatus());
		this.mUser = user;
	}

	public User getObjectOfInterest() {
		return mUser;
	}
	

}
