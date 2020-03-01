var settings = {
    APP_URL: ''
};

let url:any = document.head.querySelector('meta[name="app-url"]');

if(url) {
    settings.APP_URL = url.content+'/api';
}

export default settings;