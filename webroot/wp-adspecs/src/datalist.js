function listData (data) {
    // Get ad types as a tree
    let ulNode = document.createElement("ul");

    for (let prop in data) {
        let liNode = document.createElement("li");
        liNode.className = prop;

        // document.body.appendChild(p);

        // document.write(`<li class="${prop}">`);

        if ("object" === typeof data[prop]) {
            console.log('ul', prop, data[prop]);

            let b = document.createElement("b");
            b.innerText = prop;
            liNode.appendChild(b);

            // document.write(`<b>${prop}</b><ul class="${prop}">`);

            liNode.appendChild( listData( data[prop] ) );
            
            // document.write("</ul>");
        } else {
            // data element
            console.log('LI', prop, data[prop]);
            
            liNode.innerHTML = `${prop}: ${data[prop]}`;
            
            //document.write(prop + ": " + data[prop]);
        }
        
        // document.write("</li>");
        
        console.log( liNode );
        
        ulNode.appendChild(liNode);
    }

    return ulNode;
}

let DATA;

try {
    // Getting specsheet.json Data
    console.log("Fetching specs");

    //var specsheetsData = fetch('./data/data.json');
    fetch('./data/data.json')  // data.json or ERROR.json or DOESNOTEXIST.json
        .then(res => res.json())
        // Make an index for search

        .then(res => {
            console.log("Specs received - starting listing");


            //debugger;

            return res;
        })
        .then(function (datalist) {
            console.log('Building');
            console.log('data: ', datalist);

            DATA = datalist;
            
            let ulNode = document.createElement("ul");
            ulNode.className = "datalist";
            ulNode.appendChild( listData(datalist) );

            let listNode = document.getElementById("list");
            listNode.appendChild(ulNode);
        })


} catch (error) {
    console.error(error);
}