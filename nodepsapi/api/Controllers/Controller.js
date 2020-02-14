'use strict';

const http = require("http");
// model mysql

exports.processRequest = function(req, res) {
    let cekRouter =
    req.body.queryResult &&
    req.body.queryResult.action
      ? req.body.queryResult.action
      : "Unknown";

    console.log("Pilih Router = "+cekRouter);

    if (cekRouter == "getps") {
        getPs(req,res)
    }else if (cekRouter == "getdata"){
        getData(req,res)
    }else{
        getDunno(req,res)
    }

};

function getPs(req,res){
    let psToSearch =
    req.body.queryResult &&
    req.body.queryResult.parameters &&
    req.body.queryResult.parameters.ps
      ? req.body.queryResult.parameters.ps
      : "Unknown";

  const reqUrl = encodeURI(
    `http://ps.hokagelab.com/api/playstation/${psToSearch}?api_token=${process.env.API_KEYSA}`
  );
  
  http.get(
    reqUrl,
    responseFromAPI => {
      let completeResponse = "";
      responseFromAPI.on("data", chunk => {
        completeResponse += chunk;
      });
      responseFromAPI.on("end", () => {
        console.log("'cek = "+completeResponse);
        
        const ps = JSON.parse(completeResponse);
        console.log("cek data ps = "+ps.nama + " perjam = "+ps.harga);
        let dataToSend = psToSearch;
        dataToSend = `Kak untuk ${ps.nama} harga perjam = Rp ${ps.harga} yaa :).`;
        return res.json({
          fulfillmentText: dataToSend,
          source: "getps"
        });
      });
    },
    error => {
      return res.json({
        fulfillmentText: "Could not get results at this time",
        source: "getps"
      });
    }
  );
}

function getData(req, res){
    const reqUrl = encodeURI(
        `http://ps.hokagelab.com/api/playstation?api_token=${process.env.API_KEYSA}`
      );
      http.get(
        reqUrl,
        responseFromAPI => {
          let completeResponse = "";
          responseFromAPI.on("data", chunk => {
            completeResponse += chunk;
          });
          responseFromAPI.on("end", () => {

            const arr = JSON.parse(completeResponse);

            for (let i = 0; i < arr.length; i++) {
                console.log(arr[i].data.nama);                
            }

            let dataToSend = 'test';

            console.log("test yakk = "+dataToSend);
            
    
            // let dataToSend = psToSearch;
            // dataToSend = `Kak untuk ${ps.nama} harga perjam = Rp ${ps.harga} yaa :).`;

            return res.json({
              fulfillmentText: dataToSend,
              source: "getdata"
            });
          });
        },
        error => {
          return res.json({
            fulfillmentText: "Could not get results at this time",
            source: "getdata"
          });
        }
      );
}

function getDunno(req, res){
    res.send('Hello psbot tidak mengerti terima kasih');
}