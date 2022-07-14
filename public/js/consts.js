const BASE_URL = window.location.protocol + "//" + window.location.hostname + "/Final-Submission/public/";
const IMAGES_PATH = BASE_URL + 'images/';
const ICONS_PATH = IMAGES_PATH + 'icons/';

const crudEnum = Object.freeze({
	create: 0,
	read: 1,
	update: 2,
	delete: 3,
	none: 4
});