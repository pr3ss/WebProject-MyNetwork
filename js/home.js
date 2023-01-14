const main = document.getElementById("colMain");

//form data
axios.post('./api-feed.php'/*, numero post*/).then(response => {
    main.innerHTML = response.data;
});


/*Al inizio passare come parametro quanti caricarne poi ogni volta che arrivi a fine pagina
ne carichi altri tot capire come chidere al db solo quelli dopo a quelli gia caricati ovviamente se nel frattempo
qualche amico posta li puo vedere soltatno refreshando la 'èagina perche devono comparie in alto  */