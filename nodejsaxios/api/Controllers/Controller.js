'use strict';

const axios = require("axios");
// model mysql

exports.processRequest = function(req, res) {
    const cekRouter =
    req.body.queryResult &&
    req.body.queryResult.action
      ? req.body.queryResult.action
      : "Unknown";

    console.log("Pilih Router = "+cekRouter);

    if (cekRouter == "getps") {
        getPs(req,res)
    }else if (cekRouter == "getdata"){
        getData(req,res)
    }else if (cekRouter == "getpss") {
        getPss(req, res)
    }
    else{
        getDunno(req,res)
    }

};

function getPss(req,res){
    let psToSearch =
    req.body.queryResult &&
    req.body.queryResult.parameters &&
    req.body.queryResult.parameters.ps
      ? req.body.queryResult.parameters.ps
      : "Unknown";

    const reqUrl = encodeURI(
        `http://ps.hokagelab.com/api/playstation/${psToSearch}?api_token=${process.env.API_KEYSA}`
    );
    
    axios.get(reqUrl)
    .then(function(response) {
        const ps = response.data;
        // console.log("cek data ps = "+ps.nama + " perjam = "+ps.harga);
        let dataToSend = `Kak untuk ${ps.nama} harga perjam = Rp ${ps.harga}  yaa :).`        
        res.json({
            fulfillmentText: dataToSend,
            source: "getpss"
        });
    }).catch(function(error) {
        res.json({
            fulfillmentText: "Could not get results at this time",
            source: "getpss"
        });
    })
}

function getDunno(req, res){
    res.send('Hello psbot tidak mengerti terima kasih');
}