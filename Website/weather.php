<?php
require_once("header.php")
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="weatherforecast_stoke.js"></script>
    <section>
        <div class="weatherbox">
          <div>
                <select id="changingGraphbutton" onchange="changeGraph()">
                <option value="line">line</option>
                <option value="bar">bar</option>
                <option value="pie">pie</option>
                <option value="doughnut">doughnut</option>
                <option value="radar">radar</option>
            </select>
            
            <button onclick="clickmetochangedate(currentdate++)">next day</button>
            <button onclick="clickmetochangedate(currentdate--)">prevouis day</button>
            </div>
          <div class="charts">
            <canvas  id="Weatherchart"></canvas>
            </div>
          <div>
            <select id="changingGraphbutton2" onchange="changeGraph2()">
              <option value="line">line</option>
              <option value="bar">bar</option>
              <option value="pie">pie</option>
              <option value="doughnut">doughnut</option>
              <option value="radar">radar</option>
            </select>
            <button onclick="clickmetochangedate(currentdate++)">next day</button>
            <button onclick="clickmetochangedate(currentdate--)">prevouis day</button>
            </div>
            <div class="charts">
            <canvas id="Weatherchart2"></canvas>
            </div>
        </div>
    </section>  

<script>
//sets current day to the first day of the data
var currentdate = 0;
//passes the forecast information, the variables return an array back of all the information for their respective value
var forecast = JSON.parse(forecast_stoke);
var dateAndtime = forecast.list.map(list =>  {
    return list.dt_txt;
  });
var maintemperatures = forecast.list.map(list => {
    return list.main.temp;
  });
var feelstemperatures = forecast.list.map(list => {
    return list.main.feels_like;
  });
var mintemperatures = forecast.list.map(list => {
    return list.main.temp_min;
  });
  var maxtemperatures = forecast.list.map(list => {
    return list.main.temp_max;
  });
  var humidity = forecast.list.map(list => {
    return list.main.humidity;
  });
//calls only the first 5 values of weather information marking the first day
this.maintemperatureList = [0,1,2,3,4].map(x=>maintemperatures[x]);
this.maxtemperatureList = [0,1,2,3,4].map(x=>maxtemperatures[x]);
this.mintemperatureList = [0,1,2,3,4].map(x=>mintemperatures[x]);
this.feelstemperatureList = [0,1,2,3,4].map(x=>feelstemperatures[x]);
this.humidityList = [0,1,2,3,4].map(x=>humidity[x]);
this.dateList = [0,1,2,3,4].map(x=>dateAndtime[x]);

//creates the first chart which forecasts the temperature, Min, Max, feels like, and current temperature.
const ctx = document.getElementById('Weatherchart');
this.chart = new Chart(ctx, {
    type: "line",
    data: {
      labels: this.dateList,
      datasets: [
        {
          label: "Temperature",
          backgroundColor: "green",
          borderColor: "green",
          fill: false,
          data: this.maintemperatureList
        },
        {
          label: "Max Temperature",
          backgroundColor: "red",
          borderColor: "red",
          fill: false,
          data: this.maxtemperatureList
        },
        {
          label: "Min Temperature",
          backgroundColor: "blue",
          borderColor: "blue",
          fill: false,
          data: this.mintemperatureList
        },
        {
          label: "feels like Temperature",
          backgroundColor: "orange",
          borderColor: "orange",
          fill: false,
          data: this.feelstemperatureList,
        }
        
      ]},
    options: {  
      scales: {
  }
 }
});
//Second graph which represents humidity
const ctx2 = document.getElementById('Weatherchart2');
this.chart2 = new Chart(ctx2, {
    type: "line",
    data: {
      labels: this.dateList,
      datasets: [
        {
          label: "Humidity",
          backgroundColor: "darkblue",
          borderColor: "darkblue",
          fill: false,
          data: this.humidityList
        }
        
      ]
    },
    options: { responsive: true, 
      scales: {
    }
   }
  });
  //This function is responsible for changing the type of graph displayed e.g from line to bar
  function changeGraph(){
    //gets the value from the <select> opition so the function knows what graph to change to
    const updatetype = document.getElementById('changingGraphbutton').value;
    this.chart.config.type = updatetype;
    /*this is always called as it refreshes the positioning of the graph
    allowing for switching bewteen bar and line chart to be positioned correctly*/
    this.chart.config.options = {scales: {
            x: {
                display: true
            },
            y: {
                display: true
            }
        }, responsive: true
    };
    /*Checks if either doughnute or pie is chosen as a opition 
    repacles the colour data so that the respective graphs can be read  more clearly*/
    if(updatetype === "doughnut" || updatetype === "pie"){
     this.chart.config.data.datasets[0] = {
          label: "Temperature",
          backgroundColor: [
           'rgb(16, 0, 162)',
           'rgb(3, 145, 215)',
           'rgb(249, 169, 39)',
           'rgb(94, 53, 177)',
           'rgb(40, 165, 154)',
           'rgb(252, 110, 255)',
           'rgb(59, 255, 73)',
           'rgb(253, 255, 155)',
           'rgb(255, 25, 23)'],
          borderColor: "green",
          fill: false,
          data: this.maintemperatureList
        };
      this.chart.config.data.datasets[1] = {
          label: "Max Temperature",
          backgroundColor: [
           'rgb(16, 0, 162)',
           'rgb(3, 145, 215)',
           'rgb(249, 169, 39)',
           'rgb(94, 53, 177)',
           'rgb(40, 165, 154)',
           'rgb(252, 110, 255)',
           'rgb(59, 255, 73)',
           'rgb(253, 255, 155)',
           'rgb(255, 25, 23)'],
          borderColor: "red",
          fill: false,
          data: this.maxtemperatureList
        }
      this.chart.config.data.datasets[2] = {
          label: "Min Temperature",
          backgroundColor: [
           'rgb(16, 0, 162)',
           'rgb(3, 145, 215)',
           'rgb(249, 169, 39)',
           'rgb(94, 53, 177)',
           'rgb(40, 165, 154)',
           'rgb(252, 110, 255)',
           'rgb(59, 255, 73)',
           'rgb(253, 255, 155)',
           'rgb(255, 25, 23)'],
          borderColor: "blue",
          fill: false,
          data: this.mintemperatureList
        };
      this.chart.config.data.datasets[3] = {
          label: "feels like Temperature",
          backgroundColor: [
           'rgb(16, 0, 162)',
           'rgb(3, 145, 215)',
           'rgb(249, 169, 39)',
           'rgb(94, 53, 177)',
           'rgb(40, 165, 154)',
           'rgb(252, 110, 255)',
           'rgb(59, 255, 73)',
           'rgb(253, 255, 155)',
           'rgb(255, 25, 23)'],
          borderColor: "orange",
          fill: false,
          data: this.feelstemperatureList,
        };
      } 
      //will always reset back to default so graph can be read in bar, line and other forms and chart doesn't break
      else{this.chart.config.data.datasets[0] = {
          label: "Temperature",
          backgroundColor: "green",
          borderColor: "green",
          fill: false,
          data: this.maintemperatureList
        };
      this.chart.config.data.datasets[1] = {
          label: "Max Temperature",
          backgroundColor: "red",
          borderColor: "red",
          fill: false,
          data: this.maxtemperatureList
        }
      this.chart.config.data.datasets[2] = {
          label: "Min Temperature",
          backgroundColor:"blue",
          borderColor: "blue",
          fill: false,
          data: this.mintemperatureList
        };
      this.chart.config.data.datasets[3] = {
          label: "feels like Temperature",
          backgroundColor: "orange",
          borderColor: "orange",
          fill: false,
          data: this.feelstemperatureList,
        };}
  
      
    
    chart.update();
    this.chart.update();
      }
      //does the same as changegraph but for humidity
  function changeGraph2(){
    const updatetype = document.getElementById('changingGraphbutton2').value;
    this.chart2.config.type = updatetype;
    this.chart2.config.options = {scales: {
            x: {
                display: true
            },
            y: {
                display: true
            }
        }, responsive: true, maintainAspectRatio: false,
  
    };
    if(updatetype === "doughnut" || updatetype === "pie"){
      this.chart2.config.data.datasets[0] = {
      label: "Humidity",
          backgroundColor: [
           'rgb(16, 0, 162)',
           'rgb(3, 145, 215)',
           'rgb(249, 169, 39)',
           'rgb(94, 53, 177)',
           'rgb(40, 165, 154)',
           'rgb(252, 110, 255)',
           'rgb(59, 255, 73)',
           'rgb(253, 255, 155)',
           'rgb(255, 25, 23)'],
           borderColor: "darkblue",
          fill: false,
          data: this.humidityList};
     }else{this.chart2.config.data.datasets[0] ={
          label: "Humidity",
          backgroundColor: "darkblue",
          borderColor: "darkblue",
          fill: false,
          data: this.humidityList
        };}
        
        
    this.chart2.update();
      }
    
    /*increments date when corresponding button is pressed
    Constrains the date to only be bewteen 0 and 5 stopping the user 
    from clicking 100x times next day and having to click prev day a 100x times they only have to click it once*/
    function clickmetochangedate(){
    if(currentdate <= 0){
      currentdate = 0;
    }
    if (currentdate >= 5){
      currentdate = 5;
    }
    dateChanger(currentdate);
    }
      
  /*This function is responble for updateing the data to the corresponding day
  depending on what the current date is through the use of a switch statement
  values can be easily updated by simply writing a new array of numbers e.g if you want
  values [10,3,6] for day 0 replace all the array values with the new one and the new data will displayed.
  Both charts are updated at the same time so they stay on the same day unlike the changing graph function
  which lets you change the graphs independtly of each other */
  function dateChanger(currentdate){
    switch (currentdate){
    case 0:
      currentday = [0,1,2,3,4];
      break;
    case 1:
      currentday = [4,5,6,7,8,9,10,11,12];
      break;
    case 2:
      currentday = [12,13,14,15,16,17,18,19,20];
      break;
    case 3:
      currentday = [20,21,22,23,24,25,26,27,28];
      break;
    case 4:
      currentday = [28,29,30,31,32,33,34,35,36];
      break;
    case 5:
      currentday = [36,37,38,39,40];
      break;
    }
    this.dateList = currentday.map(x=>dateAndtime[x]);
    this.chart.config.data.labels = this.dateList;
    this.humidityList = currentday.map(x=>humidity[x]);
    this.chart2.config.data.labels = this.dateList;
    this.chart2.config.data.datasets[0].data = this.humidityList;
    this.maintemperatureList = currentday.map(x=>maintemperatures[x]);
    this.maxtemperatureList = currentday.map(x=>maxtemperatures[x]);
    this.mintemperatureList = currentday.map(x=>mintemperatures[x]);
    this.feelstemperatureList = currentday.map(x=>feelstemperatures[x]);
    this.chart.config.data.datasets[0].data = this.maintemperatureList;
    this.chart.config.data.datasets[1].data = this.maxtemperatureList;
    this.chart.config.data.datasets[2].data = this.mintemperatureList;
    this.chart.config.data.datasets[3].data = this.feelstemperatureList;
    this.chart.update();
    this.chart2.update();
  }
</script>

    <?php
require_once("footer.php")
?>