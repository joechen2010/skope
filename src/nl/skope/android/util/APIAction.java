package nl.skope.android.util;

public enum APIAction {

    MAIN("MAIN"), READUSER("READUSER"), SIGNUP("SIGNUP"), LOGIN("LOGIN"), LOGOUT("LOGOUT"), INFO("INFO")
    , PHOTO("PHOTO"), REGISTRATION("REGISTRATION"),
    LOCATION("LOCATION"), FAVORITES("FAVORITES"),CHAT("LOCATION"), PHOTOS("PHOTOS"), REPORT("REPORT");
    private String name;

    private APIAction(String name) {
        this.name = name;

    }

    public String getName() {
        return name;
    }

    public static APIAction valueOfName(String name) {
        for (APIAction e : APIAction.values()) {
            if (e.getName().equals(name)) {
                return e;
            }
        }
        return null;
    }

}
