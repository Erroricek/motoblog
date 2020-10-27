<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <script type="text/javascript" src="https://api.mapy.cz/loader.js"></script>
    <script type="text/javascript">Loader.load();</script>
</head>

<body>
    <div id="m" style="height:380px; width:600px;"></div>
</body>
</html>


<script>
var center = SMap.Coords.fromWGS84(14.41790, 50.12655);
var m = new SMap(JAK.gel("m"), center, 13);
m.addDefaultLayer(SMap.DEF_BASE).enable();
m.addDefaultControls();

var layer = new SMap.Layer.Geometry();
m.addLayer(layer);
layer.enable();

var points1 = [
    SMap.Coords.fromWGS84(14.417895, 50.126554),
    SMap.Coords.fromWGS84(14.426672, 50.123787),
    SMap.Coords.fromWGS84(14.413489, 50.129343),
    SMap.Coords.fromWGS84(14.417963, 50.120933)
];
var options1 = {
    color: "#f00",
    width: 3
};
var polyline = new SMap.Geometry(SMap.GEOMETRY_POLYLINE, null, points1, options1);
layer.addGeometry(polyline);

var points2 = [
    SMap.Coords.fromWGS84(14.418537, 50.126094),
    SMap.Coords.fromWGS84(14.422892, 50.127521),
    SMap.Coords.fromWGS84(14.420757, 50.123295)
];
var options2 = {
    color: "#00f"
};
var polygon = new SMap.Geometry(SMap.GEOMETRY_POLYGON, null, points2, options2);
layer.addGeometry(polygon);
</script>




<?php

    

?>


