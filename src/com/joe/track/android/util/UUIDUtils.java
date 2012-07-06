package com.joe.track.android.util;

import java.util.concurrent.atomic.AtomicLong;

public final class UUIDUtils {
    private static final long   TIME_MILLIS_OF_2007_01_01 = 1170313096428L;

    private static final String DEFAULT_NODE_ID           = "10";

    private static AtomicLong   atomicLong;

    private static String       nodeId;



    static {
        init();
    }

    private static void init() {
        atomicLong = new AtomicLong((System.currentTimeMillis() - TIME_MILLIS_OF_2007_01_01) * 100L);
    }

    public static Long generate() {
        if (nodeId == null || "".equals(nodeId)) {
            nodeId = DEFAULT_NODE_ID;
        }
        return new Long(new StringBuilder().append(nodeId).append(atomicLong.incrementAndGet()).toString());
    }

    public static void setNodeId(String nodeId) {
        UUIDUtils.nodeId = nodeId;
    }

}
