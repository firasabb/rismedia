window.addEventListener('load', function () {
    
    document.getElementById('btn-csv').addEventListener("click", function() {
        var html = document.querySelector("table").outerHTML;
        exportCsv(html);
    });
    
    function exportCsv(html) {
        var csv = [];
        var rows = document.querySelectorAll("table tr");
        if(rows.length > 0){

            for (let i = 0; i < rows.length; i++) {

                var row = [];
                var cols = rows[i].querySelectorAll("td, th");

                for (let j = 0; j < cols.length; j++){
                    row.push(cols[j].innerText);
                } 

                csv.push(row.join(","));		

            }
            csv = csv.join("\n");
            let a = document.createElement("a");
            let c = new Blob([csv], {type: "text/csv"});
            a.setAttribute('href', window.URL.createObjectURL(c));
            a.style.display = "none";
            a.download = document.title + '.csv';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);

        }
    }


    }, false);