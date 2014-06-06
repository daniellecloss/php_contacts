/*
 * Author: Danielle Closs
 * File: main application js file, has functions for search and edit contact form
 * Date:6/6/2012
 */
$j = jQuery.noConflict();
var app = {};
app.init = function(){
    var panel= $j("#adminForm .radio_group");
    var radioInputs = $j(panel).find('input[type=radio]');
    radioInputs.click(function(e){
        var formType = $j(this).val();
        if(formType == 'add'){
            $j('input#contact_id').prop('disabled', true);
            $j('input#contact_firstname, input#contact_lastname, '+
                'input#address, input#city, input#state, input#zip').prop('disabled', false);
        }
        else if(formType == 'update'){
            $j('input#contact_id').prop('disabled', false);
            $j('input#contact_firstname, input#contact_lastname, input#address, '+
                'input#city, input#state, input#zip').prop('disabled', false);
        }
        else if(formType == 'delete'){
            $j('input#contact_id').prop('disabled', false);
            $j('input#contact_firstname, input#contact_lastname, input#address,'+
                ' input#city, input#state, input#zip').prop('disabled', true);
        }
        });
};
app.search = function(){
    YUI().use('node','io','json','datatable', function (Y) {
        Y.on('click', function(){
            var form = Y.one('#searchForm'),
                id = form.one('#contact_id').get('value'),
                firstname = form.one('#contact_firstname' ).get('value'),
                lastname = form.one('#contact_lastname' ).get('value'),
                address = form.one('#address' ).get('value'),
                city = form.one('#city' ).get('value'),
                state = form.one('#state' ).get('value'),
                zip = form.one('#zip' ).get('value'),
                url = form.get('action');

            Y.io(url, {
                method: "POST",
                data: {
                    "contact_id" : id,
                    "contact_firstname" : firstname,
                    "contact_lastname" : lastname,
                    "address" : address,
                    "city" : city,
                    "state" : state,
                    "zip" : zip
                },
                on: {
                    success: function (id, data) {
                        var content = data.response;
						console.log(data.response);
                        var firstBracket = content.indexOf('[');
                        var lastBracket = content.indexOf(']');
                        if(firstBracket && lastBracket){
                            content = content.substring(firstBracket, lastBracket+1);
                            // protected against malformed JSON response
                            try {
                               content = Y.JSON.parse(content);
                            }
                            catch (e) {
                                alert('No results found.  Please try another search.');
                                return;
                            }
                        }
                        var table = new Y.DataTable({
                            columns: ["contact_id", "contact_firstname", "contact_lastname", 'address', 'city', 'state', 'zip'],
                            data: content
                        });
                        Y.one("#example").empty();
                        table.render("#example");
                    }
                }
            })

        }, '#submitButton');
    });
};
$j(document).ready(function(){
    app.init();
    app.search();
});