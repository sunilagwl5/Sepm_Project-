/*
 * Fabtabulous! Simple tabs using Prototype
 * http://tetlaw.id.au/view/blog/fabtabulous-simple-tabs-using-prototype/
 * Andrew Tetlaw
 * version 1.1 2006-05-06
 * http://creativecommons.org/licenses/by-sa/2.5/
 */
var Fabtabs = Class.create();

Fabtabs.prototype = {
	initialize : function(element) {
		this.element = $(element);
		var options = Object.extend({}, arguments[1] || {});
		this.menu = $A(this.element.getElementsByTagName('a'));
		this.show(this.getInitialTab());
		this.menu.each(this.setupTab.bind(this));
	},
	setupTab : function(elm) {
		Event.observe(elm,'click',this.activate.bindAsEventListener(this),false)
	},
	activate :  function(ev) {
		var elm = Event.findElement(ev, "a");
		Event.stop(ev);
		this.show(elm);
		this.menu.without(elm).each(this.hide.bind(this));
	},
	hide : function(elm) {
		$(elm).removeClassName('active-tab');
		$(this.tabID(elm)).removeClassName('active-tab-body');
	},
	show : function(elm) {
		var x=elm;
		cookievalue= x + ";";
   		document.cookie="name=" + cookievalue;
		//alert(x);
		$(elm).addClassName('active-tab');
		$(this.tabID(elm)).addClassName('active-tab-body');


	},
	tabID : function(elm) {
		return elm.href.match(/#(\w.+)/)[1];
	},
	getInitialTab : function() {
			
			//var x=this.dataStore.getItem(this.index_key);
			
			var allcookies = document.cookie;
			cookiearray  = allcookies.split(';');
			//alert(cookiearray);
			x = cookiearray[0].split('=')[1];
			var link2=x.split('#');
			//var link2size=sizeof(link2);
			//alert(x);
			//return $A(x)[0];
			//x=x.split('#');
			//alert(x[1])
			//return value;
			//alert(value);
			//var x = $.cookie('selected-tab');
			//return eval(x);
			//alert(x);
			 
			var link=(document.URL).split('/');
			//link=link.split(',');
			var size_l=link.length-1;
			alert(link[size_l]);
			//alert(link2[1]);
			if(link[size_l]=="faculty.php")
			{
				if(link2[1]=="FacultyCoursesUndertaken")
					return this.menu[1];
				else if(link2[1]=="FacultyGradingAndMarks")
					return this.menu[2];
				else if(link2[1]=="Addupdates")
					return this.menu[3];
				else if(link2[1]=="Changepassword")
					return this.menu[4];
			}			
			else if(link[size_l]=="student.php")
			{
				if(link2[1]=="CurrentCourses")
					return this.menu[1];
				else if(link2[1]=="PreviousResults")
					return this.menu[2];
				else if(link2[1]=="Changepassword")
					return this.menu[3];
			}
			else if(link[size_l]=="admin.php")
			{
				
				if(link2[1]=="AddNewFaculty")
					return this.menu[1];
				else if(link2[1]=="AddNewCourses")
					return this.menu[2];
				else if(link2[1]=="EditStudent")
					return this.menu[3];
				else if(link2[1]=="EditFaculty")
					return this.menu[4];
				else if(link2[1]=="GradingAndMarks")
					return this.menu[5];
				else if(link2[1]=="Addupdates")
					return this.menu[6];
				
				else if(link2[1]=="Changepassword")
					return this.menu[7];
			}
			
				return this.menu[0];
		
		
	}
}
