//import of express library.
const experess = require('express');

//definition of the express class so that I can use the methods inside it, in this case app.get();
const app = experess();

//PORT defining in case of virtual host or external hosting.
const port =  process.env.PORT || 3000;

const BodyParser = require('body-parser');

app.use(BodyParser.json());
var ip;
require('dns').lookup(require('os').hostname(), function (err, add, fam) {
    ip=add;
});

//simple definitions of premade url strings to use for later.
var rutaGenerica = `http://${ip}:${port}`;
var rutaApi = "/api/origin/platform/";



//the root page, in this case localhost, will show this welcome message
app.get('/', (req, res) =>{
    res.send(`Default Page`);
});

//general route of the api so it shows all data.
app.get(rutaApi, (req, res) =>{
    
    res.send("Tot correcte");
});





//listener.
app.listen(port, () => console.log(`Listening on port ${port}...`));