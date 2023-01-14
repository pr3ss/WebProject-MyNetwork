const main = document.getElementById("colMain");

//form data
axios.post('./api-feed.php'/*, numero post*/).then(response => {
    main.innerHTML = response.data;
});

/*codice copiato è quello che fa jquery per compatibilita tra i browser */
var body = document.body,
    html = document.documentElement;

var height = Math.max( body.scrollHeight, body.offsetHeight, 
                       html.clientHeight, html.scrollHeight, html.offsetHeight );

console.log(height);

window.onscroll = function(ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        console.log("fine");
        axios.post('./api-feed.php'/*, numero post*/).then(response => {
            main.innerHTML += response.data;
        });
        var body = document.body,
            html = document.documentElement;

        var height = Math.max( body.scrollHeight, body.offsetHeight, 
                            html.clientHeight, html.scrollHeight, html.offsetHeight );

        console.log(height);
    }
};

/*Al inizio passare come parametro quanti caricarne poi ogni volta che arrivi a fine pagina
ne carichi altri tot capire come chidere al db solo quelli dopo a quelli gia caricati ovviamente se nel frattempo
qualche amico posta li puo vedere soltatno refreshando la 'èagina perche devono comparie in alto 
valutare se i primi carficarli sempre con js oppure fare call db in home e usare require in base.php cosa 
fattibile solo la prima volta poi bisogna caricarli per forza con js forse meglio tutto su js cosi abbiamo un
unico posto dove carichiamo */