<?php $less = $_POST['less']; 

/*1. replace @ with $*/
$scss = preg_replace('/@(?!import|media|keyframes|-)/', '$', $less);
/*2. replace mixins*/
$scss = preg_replace('/\.([\w\-]*)\s*\((.*)\)\s*\{/', '@mixin \1(\2){', $scss);
/*3. replace includes*/
$scss = preg_replace('/\.([\w\-]*\s*;)/', '@include \1', $scss);
$scss = preg_replace('/\.([\w\-]*\(.*\)\s*;)/', '@include \1', $scss);
$scss = preg_replace('/\.\([a-z0-9-]\+/', '@include \1(/', $scss);
/*3. a) replace no param mixin includes with empty parens*/
$scss = preg_replace('/@include\ ([\w\-]*\s*;)/', '@include \1()', $scss);
$scss = preg_replace('/;\(\)/', '();', $scss);
/* 4. replace string literals */
$scss = preg_replace('/~"(.*)"/', '#{"\1"}', $scss);
/* 5. replace spin to adjust-hue (function name diff) */
$scss = preg_replace('/spin/', 'adjust-hue', $scss);
# 6. replace all the file maps

if(!isset($_POST['ajax'])){
	include('index.php');
}else{
	echo $scss;
}
?>