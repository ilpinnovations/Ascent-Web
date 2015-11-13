Ascent DB Details:
---------------------------
For testing, GET requests are enabled, but in production only POST request will work.
Maximum comment size: 250 characters
Range of rating: 1-5


to get all the regions:
http://theinspirer.in/ascent?action=getRegion

to register a new user:
http://theinspirer.in/ascent?action=register&empId=962118&empName=Milind%20Gour&regionId=1&emailId=gour.milind@gmail.com

to get schedule:
http://theinspirer.in/ascent?action=getSchedule&date=2015-09-09&regionId=1

to store the feedback:
http://theinspirer.in/ascent?action=setFeedback&schedId=220&empId=962118&rating=5&comments=some%20comments