<?php

print "

if (navigator.appVersion=='') { var Nav3compatible = false; } else { var Nav3compatible = !(eval(navigator.appVersion.substring(0,3))<3); } 
if (Nav3compatible) {
var NN3 = false;

image1= new Image();
image1.src = \"./images/add_logo1.jpg\";
image1on = new Image();
image1on.src = \"./images/add_logo1_d.jpg\";

image2= new Image();
image2.src = \"./images/list_people_logo1.jpg\";
image2on = new Image();
image2on.src = \"./images/list_people_logo1_d.jpg\";

image3= new Image();
image3.src = \"./images/add_logo1.jpg\";
image3on = new Image();
image3on.src = \"./images/add_logo1_d.jpg\";

image4= new Image();
image4.src = \"./images/list_tickets_logo1.jpg\";
image4on = new Image();
image4on.src = \"./images/list_tickets_logo1_d.jpg\";

}

function on3(name)   {
        document[name].src = eval(name + \"on.src\");
}
function off3(name)  {
        document[name].src = eval(name + \".src\");
}
NN3 = true;
function on(name)  {
if (Nav3compatible) {
        if (NN3) on3(name);
}
}
function off(name)  {
if (Nav3compatible) {
        if (NN3) off3(name);
}
}

";

?>