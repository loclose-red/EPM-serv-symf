console.log('dans fichier js')



document.addEventListener('DOMContentLoaded', () => {

    // récupération des données envoyées dans les "div data-entry..."

    //récupération ids poits de mesures
    const entryElements =
        document.querySelectorAll('[data-entry-id]');
    const entryIds =
        Array.from(entryElements).map(
            item => item.dataset.entryId
        );
    //récupération des mesures (un tableau par ensemble de mesures)
    const entryElementsMesures =
        document.querySelectorAll('[data-entry-mesures]');
    const entryMesures =
        Array.from(entryElementsMesures).map(
            item => item.dataset.entryMesures
        );
    //récupération des dates mesures (un tableau par ensemble de dates)
    const entryElementsDates =
        document.querySelectorAll('[data-entry-dates]');
    const entryDates =
        Array.from(entryElementsDates).map(
            item => item.dataset.entryDates
        );

    //appel de construction d'un graphique par ids
    entryIds.forEach((unId, index) => {
        //création de l'id correspondant à la balise <canvas> de graphique chart_js
        idGraphique = "unGraphique_" + unId
        //mise en forme du tableau des mesures passées à la construction du graphique
        mesuresGraphique = JSON.parse(entryMesures[index]);
        //mise en forme du tableau des dates passées à la construction du graphique
        datesGraphique = JSON.parse(entryDates[index]);
        
        buildGraph(idGraphique,mesuresGraphique,datesGraphique)
    })


});



//--------------------------------------------------------------------------------------------------------

//construction du graphique chart_js
function buildGraph(idCanvasGraph,grMesures,grDates){
    //var ctx = document.getElementById('myChart').getContext('2d');
    var ctx = document.getElementById(idCanvasGraph).getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            //labels: tableauLabels,
            //labels: monTableauDates,
            labels: grDates,
            datasets: [{
                label: 'températures',
                //data: tableauDatas,
                //data: monTableauMesures,
                data: grMesures,
                
                borderWidth: 3,
                borderColor: 'green',
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

