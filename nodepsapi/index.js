//use path module

const http = require("http");
//use express module
const 
express = require("express"),
bodyParser   = require('body-parser');

//use mysql database
// const mysql = require("mysql");

const app = express();
const PORT = process.env.PORT || 3000;

var routes = require('./api/Router'); //importing route

// import env variables
require("dotenv").config();

app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

app.get("/", (req, res) => {
  res.status(200).send("Server is working.");
});

routes(app); //register the route

app.listen(PORT, () =>{
  console.log("Server is up and listening on port = " + process.env.PORT);
});

// app.listen(port, () => {
//   console.log(`🌏 Server is running at http://localhost:${port}`);
// });


// app.post("/movie", function(req, res) {
//   const movie = req.body.result.parameters.movie;
//   res.send(movie);
// });

// get movie
// app.post("/getmovie", (req, res) => {
//   let movieToSearch =
//     req.body.result &&
//     req.body.result.parameters &&
//     req.body.result.parameters.movie
//       ? req.body.result.parameters.movie
//       : "Unknown";

//   const reqUrl = encodeURI(
//     `http://www.omdbapi.com/?t=${movieToSearch}&apikey=${process.env.API_KEY}`
//   );
//   http.get(
//     reqUrl,
//     responseFromAPI => {
//       let completeResponse = "";
//       responseFromAPI.on("data", chunk => {
//         completeResponse += chunk;
//       });
//       responseFromAPI.on("end", () => {
//         const movie = JSON.parse(completeResponse);
//         let dataToSend = movieToSearch;
//         dataToSend = `${movie.Title} was released in the year ${movie.Year}. It is directed by ${movie.Director} and stars ${movie.Actors}.\n Here some glimpse of the plot: ${movie.Plot}.
//                   }`;
//         return res.json({
//           fulfillmentText: dataToSend,
//           source: "getmovie"
//         });
//       });
//     },
//     error => {
//       return res.json({
//         fulfillmentText: "Could not get results at this time",
//         source: "getmovie"
//       });
//     }
//   );
// });
// get movie

// get ps
// app.post("/getps", (req, res) => {
// });
// get ps
