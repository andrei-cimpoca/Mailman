Mailman
=======

Mailman Romania shipping module
http://mm.dev4.clientproof.co.uk/cws/?HTML

Requires vqMod for AWB generation.
https://github.com/vqmod/vqmod/wiki/Installing-vQmod-on-OpenCart

TODO
====
replace: vqmod/xml/opencart_admin_order_controller.xml@64
$awb = json_encode($soap->getAWB($this->request->get['awb']));
with whatever the method will be named and remove json encoding