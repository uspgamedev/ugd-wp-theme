/*

This script fixes a single-post or page's height when their size is bigger than the window's.

*/

var classesQueue = {
	vertalgn: [getElemetsInHtmlCollection( document.getElementsByClassName('vert-algn') ), 'vert-algn'],
	vertalgnsm: [getElemetsInHtmlCollection( document.getElementsByClassName('vert-algn-sm') ), 'vert-algn-sm'],
	vertalgnmd: [getElemetsInHtmlCollection( document.getElementsByClassName('vert-algn-md') ), 'vert-algn-md']
}

function getElemetsInHtmlCollection(htmlcollection) {
	var list = [];
	for (var i = 0; i < htmlcollection.length; i++) {
		list.push(htmlcollection[i]);
	};
	return list;
}

function fixHeight() {
	console.log("looking for height disparities...");
	
	fixHeightByClass(classesQueue.vertalgn[0], classesQueue.vertalgn[1]);
	fixHeightByClass(classesQueue.vertalgnsm[0], classesQueue.vertalgnsm[1]);
	fixHeightByClass(classesQueue.vertalgnmd[0], classesQueue.vertalgnmd[1]);
}

function fixHeightByClass(queue, classname) {
	console.log(classname);
	console.log(queue);
	for (var i = 0; i < queue.length; i++) {
		var element = queue[i];
		var maxHeight = element.parentNode.offsetHeight;
		console.log(element);
		console.log(element.offsetHeight + " >= " + maxHeight + "?");
		if (element.offsetHeight >= maxHeight) {
			element.classList.remove(classname);
		} else {
			element.classList.add(classname);
		}
	};
};

//window.setInterval(fixHeight, 500);