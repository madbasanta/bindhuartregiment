const routes = {
	404: {
		template: "/404/404.html",
		title: "404 error ",
		description: "Page not found",
	},
	"/": {
		template: "/home/index.html",
		title: "Bindhu Art Regiment | Home",
		description: "This is the home page",
	},
	aboutus:{
       template : "/about/aboutus.html",
	   title : "About US",
	   description : "About US"

	},
	getintouch: {
		template: "/getintouch/getintouch.html",
		title: "GET in TOUCH",
		description: "This is the about page",
	},
	projects: {
		template: "/projects/projects.html",
		title: "Our Projects",
		description: "Bindhu Art Regiment | Our Projects",
	},
	getfeatured:{
		template : "/collaboration/collab.html",
		title : "our collaboration",
		description : "collaboration",
	},
	artistprofile:{
		template : "/artist/artist.html",
		title : "artistprofile",
		description : "artist",
	},
	artist1:{
		template : "/artist/artists/artist1.html",
		title : "artistprofile",
		description : "artist",
	},
	artist2:{
		template : "/artist/artists/artist2.html",
		title : "artistprofile",
		description : "artist",
	},
	artist3:{
		template : "artist/artists/artist3.html",
		title : "artistprofile",
		description: "artist",
	},
	artist4:{
		template : "artist/artists/artist4.html",
		title : "artistprofile",
		description: "artist",
	},
	artist5:{
		template : "artist/artists/artist5.html",
		title : "artistprofile",
		description: "artist",
	},
	artist6:{
		template : "artist/artists/artist6.html",
		title : "artistprofile",
		description: "artist",
	},
	artist7:{
		template : "artist/artists/artist7.html",
		title : "artistprofile",
		description: "artist",
	},
	artist8:{
		template : "artist/artists/artist8.html",
		title : "artistprofile",
		description: "artist",
	},
	artist9:{
		template : "artist/artists/artist9.html",
		title : "artistprofile",
		description: "artist",
	},
	podcast:{
		template : "/podcast/podcast",
		title : "podcast",
		description : "podcast",
	},
	article1:{
		template : "/article/article1.html",
		title : "article",
		description : "article",
	},
	article2:{
		template : "/article/article2.html",
		title : "article",
		description : "article",
	},
	article3:{
		template : "/article/article3.html",
		title : "article",
		description : "article",
	},
	articlemain:{
		template : "/article/articlemain.html",
		title : "articles",
		description : "articlemainpage",
	},
	podcastmain:{
		template : "/podcast/podcastmain",
		title : "podcast",
		description : "podcastmainpage",
	},
	thankyou:{
		template : "/thankyou/thankyou.html",
		title : "DHANYEBAD",
		description : "thanyou",
	},
	whatarewe:{
		template : "/whatarewe/wre.html",
		title : "Hami Ko hou ?",
		description : "hami ko hou ?"
	},
	project1:{
		template:"/projects/project_1/project-1.html",
		title : "Gandarva",
		description :"Gandharva"
	},
	project2:{
		template:"/projects/project_2/project-2.html",
		title : "Fill the space",
		description :"Fill the space"
	},
	project3:{
		template:"/projects/project_3/project-3.html",
		title : "WAHUIMA",
		description :"WAHUIMA"
	},
	project4:{
		template:"/projects/project_4/project-4.html",
		title : "FILHAL White noise",
		description :"FILHAL White noise"
	},
	privacypolicy:{
		template:"/privacypolicy/privacy_policy.html",
		title : "Privacy Policy",
		description :"Privacy Policy"
	},
	supportus:{
		template:"/supportus/supportus.html",
		title : "Support us",
		description :"support us"
	}

};
const locationHandler = async () => {
	var location = window.location.hash.replace("#", "");
	if (location.length == 0) {
		location = "/";
	}
	[location, query] = location.split("?");
	const route = routes[location] || routes["404"];
	const html = await fetch(route.template + (query ? `?${query}` : "")).then((response) => response.text());
	document.getElementById("content").innerHTML = html;
	document.title = route.title;
	document
		.querySelector('meta[name="description"]')
		// .setAttribute("content", route.description);

		// Check if the device is a mobile device
		function isMobileDevice() {
			return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
		}
		
		// Call scrollToTop() only if the device is a mobile device
		if (isMobileDevice()) {
			// scrollToTop();
			window.scrollTo({ top: 0, behavior: 'smooth' });
			
		}
		if (window.innerWidth >= 720) {
			// Scroll to the top of the page
			window.scrollTo({ top: 0, behavior: 'smooth' });
		  }
		
};
window.addEventListener("hashchange", locationHandler);

locationHandler();
