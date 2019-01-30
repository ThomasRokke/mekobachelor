
/*
    Title: Form instruksjoner
    Description:
    Author: Thomas Røkke
    Date: 18.12.2017
*/
(function() {
    //HTML objects init

    var newInstBtn; //init new instruction button
    var instContainer;
    var nrOfInst = 2; //starter på 2 siden 1 allerede eksisterer.
    var nrOfProducts = 1;
    var totalNr = 1;
    var products = [];
    var fromInput;
    var tooInput;
    var productsContainer;
    var addedProducts;

    var fromResults;
    var tooResults;

    var sessiontoken = "987654321";

    var fromTimeOut;


    //init function
    const init = function() {
        const setHTMLObjects = function() {



            fromInput = document.getElementById('from');

            fromResults = $('#fromAppend');


            setInterval(function() {
                sessiontoken = Math.random().toString(36).substring(5);
            }, 160 * 1000); // 60 * 1000 milsec



            fromTimeOut = null;




        }(); //end setHTMLObjects
        //Set events
        var setEvents = function() {

            fromInput.addEventListener('keydown', getFromPlaces, false);





        }(); //setEvents end

        //fromInput.addEventListener("change", getPlaces(event));

    }(); //end init
    //application logic


    function isFormReady(){



        return false;
    }

    function getFromPlaces(e){



        var value = e.target.value;


        console.log(e.type);
        var key = e.which || e.keyCode;
        if (key === 13) { // 13 is enter

            var url = "http://localhost:8000/"+sessiontoken+"/testapi/"+e.target.value;
            $.ajax({
                url: url,
                type: 'GET',
                dataType:'json',
                success: function(data){

                    var anyResults = false; //check if any results have been added
                    //check if the results contain anything.
                    if(data['status'] === "OK") {


                        var lengde = data['results']['length'];

                        //empty the previous results
                        fromResults.empty();
                        //hide the div so it can be later animated to show
                        fromResults.hide();


                        //loop through the results
                        for(var i = 0; i < lengde; i++){
                            var nameOnclick = "'"+data['results'][i]['name']+"'";


                            var typeArr = data['results'][i]['types'];

                            //Change this to a blacklist of values not accepted instead of whitelisting because of depricated values in places API
                            var check = ["country", "locality", "postal_code"];

                            var found = false;
                            for (var d = 0; d < check.length; d++) {
                                if (typeArr.indexOf(check[d]) > -1) {
                                    found = true;
                                    console.log("found bby");
                                    break;

                                }
                            }

                            if(!found){
                                var placeID = "'"+data['results'][i]['place_id']+"'";
                                var isAddress = false;

                                if (typeArr.indexOf("street_address") > -1) {
                                    isAddress = true;

                                }

                                fromResults.append('<a   onclick="chooseFrom('+nameOnclick +","+placeID +","+ isAddress+')" class="list-group-item"><b><img src="'+data['results'][i]['icon']+'" width="20" height="20" alt=""> '+data['results'][i]['name']+'</b>, '+data['results'][i]['formatted_address']+'</a>')

                                anyResults = true;

                            }

                        }//end for loop


                    }



                    if(!anyResults){
                        fromResults.empty();
                        fromResults.append('<a   onclick="focusSearch(true)" class="list-group-item"> Beklager, ingen treff på søket: <b>"'+e.target.value+'".</b> Forsøk å legge til stednavn slik: <b>"'+e.target.value+', Oslo"</b> <br>' +
                            'Du kan også skrive inn addressen og manuelt fylle inn navn..</a>')

                    }

                    //display the results
                    fromResults.show("slow");

                }
            });

        }else if(value.length > 2){

            console.log(e.target.value);
            var url = "http://localhost:8000/autocomplete/"+sessiontoken+"/"+e.target.value;

            $.ajax({
                url: url,
                type: 'GET',
                dataType:'json',
                success: function(data){

                    var anyResults = false; //check if any results have been added
                    //check if the results contain anything.
                    if(data['status'] === "OK") {



                        var lengde = data['predictions']['length'];

                        //empty the previous results
                        fromResults.empty();
                        //hide the div so it can be later animated to show
                        fromResults.hide();


                        //loop through the results
                        for(var i = 0; i < lengde; i++){
                            var nameOnclick = "'"+data['predictions'][i]['structured_formatting']['main_text']+"'";


                            var typeArr = data['predictions'][i]['types'];

                            //Change this to a blacklist of values not accepted instead of whitelisting because of depricated values in places API
                            var check = ["country", "locality", "postal_code"];

                            var found = false;
                            for (var d = 0; d < check.length; d++) {
                                if (typeArr.indexOf(check[d]) > -1) {
                                    found = true;
                                    console.log("found bby");
                                    break;

                                }
                            }

                            if(!found){
                                var placeID = "'"+data['predictions'][i]['place_id']+"'";
                                var isAddress = false;

                                if (typeArr.indexOf("street_address") > -1) {
                                    isAddress = true;

                                }

                                fromResults.append('<a  onclick="chooseFrom('+nameOnclick +","+placeID +","+ isAddress+')" class="list-group-item"><b><i class="fa fa-map-marker"></i> '+data['predictions'][i]['structured_formatting']['main_text']+'</b>, '+data['predictions'][i]['structured_formatting']['secondary_text']+'</a>')

                                anyResults = true;

                            }

                        }//end for loop


                    }



                    if(!anyResults){
                        fromResults.empty();
                        fromResults.append('<a   onclick="focusSearch(true)" class="list-group-item"> Beklager, ingen treff på søket: <b>"'+e.target.value+'".</b> Forsøk å legge til stednavn slik: <b>"'+e.target.value+', Oslo"</b> <br>' +
                            'Du kan også skrive inn addressen og manuelt fylle inn navn..</a>')

                    }

                    //display the results
                    fromResults.show();

                }
            });
        }else{
            fromResults.empty();
            fromResults.hide();
        }

    }







    chooseFrom = function(name, placeID, isAddress){

        $('#fromID').val(placeID);


        console.log('from selected');


        //Save the new place in the database
        var url = "http://localhost:8000/searchplacesapi?session="+sessiontoken+"&placeid="+placeID;
        $.ajax({
            url: url,
            type: 'GET',
            dataType:'json',
            success: function(data){

                console.log(data);

                //check if the results contain anything.
                if(data['status'] === "OK") {
                    console.log("Saved to the database");
                    var resultAddress = data['result']['formatted_address'];
                    var resultname = data['result']['name'];

                    console.log(data);
                    if(isAddress){

                        $('#from').val(resultAddress).prop("readonly", true);
                        $('#fromAppend').empty();
                    }else{

                        $('#from').val(resultname).prop("readonly", true);
                        $('#fromAppend').empty();
                    }

                    //formatted_address
                    $('#adr').val(data['result']['formatted_address']);
                    $('#lat').val(data['result']['geometry']['location']['lat']);
                    $('#lng').val(data['result']['geometry']['location']['lng']);

                    $('#fromAdr').text(resultAddress).show();
                    $('#fromDelete').show();



                }

            }
        });




    }


    focusSearch = function(type){
        //true = from, false = to
        if(type){

            $('#from').val('').focus();

            $('#fromAppend').empty();

        }else{
            $('#too').val('').focus();

            $('#tooAppend').empty();
        }
    }


    deleteFrom = function(){
        $('#from').prop("readonly", false).focus();
        $('#fromID').empty();
        $('#adr').empty();
        $('#lat').empty();
        $('#lng').empty();

        $('#fromDelete').hide();
        $('#fromAdr').hide();

    }










}()); //end encapsulation

//prevent submitting form by pressing enter key
$(document).on("keypress", ":input:not(textarea)", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
    }
});