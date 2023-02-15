
@extends('layouts.admin')


@section('content')
  <div class="container p-2">
    <h3><i class="material-icons">{{ $client->name }}</h3>
    <hr>
    <div id="suivi" class="container pl-5 pr-5 ml-3">
        <div class="table-responsive">
            <table class="table table-sm table-striped table-header-dark data-table">
                <thead>
                    <tr>
                        <td id="search-input">

                        </td>
                    </tr>
                    <tr>
                        <th>Id Client</th>
                        <th>Client</th>
                        <th>Montant facturé</th>
                        <th>Montant payé</th>
                        <th>Montant dû</th>
                        <th>Montant impayé</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="tr-click" data-id="1" role="button">
                        <td>5767</td>
                        <td>Hippo Plastic</td>
                        <td>56.789.000</td>
                        <td>45.678.000</td>
                        <td>11.134.000</td>
                        <td>7.078.000</td>
                    </tr>
                    <a href="/admin/suivi/client/1">
                    <tr role="button">
                        <td>5767</td>
                        <td>Hippo Plastic</td>
                        <td>56.789.000</td>
                        <td>45.678.000</td>
                        <td>11.134.000</td>
                        <td>7.078.000</td>
                    </tr>
                    </a>
                    <tr role="button">
                        <td>5767</td>
                        <td>Hippo Plastic</td>
                        <td>56.789.000</td>
                        <td>45.678.000</td>
                        <td>11.134.000</td>
                        <td>7.078.000</td>
                    </tr>
                    <tr>
                        <td>5767</td>
                        <td>Hippo Plastic</td>
                        <td>56.789.000</td>
                        <td>45.678.000</td>
                        <td>11.134.000</td>
                        <td>7.078.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <hr>
        <div style="margin-left:20px">
            <table id="jqGrid"></table>
            <div id="jqGridPager"></div>
        </div>
    </div>
    </div>
  </div>

  <style>
    .table-header-dark>thead>tr>th{
        background-color: #333333;
        color: #ffffff;
    }
  </style>

 <script>
    $('.tr-click').click(function(){
        var id = $(this).data('id');
        window.location.href='/admin/suivi/client/'+id;
    });
</script>
<script src="//cdn.jsdelivr.net/free-jqgrid/4.8.0/js/i18n/grid.locale-fr.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/free-jqgrid/4.8.0/js/jquery.jqgrid.min.js"></script>
<script>
    $.jgrid.defaults.width = 780;
    $.jgrid.defaults.responsive = true;
    $.jgrid.defaults.styleUI = 'Bootstrap';
</script>


<script type="text/javascript">

$(document).ready(function () {
    $("#jqGrid").jqGrid({
        url: '/data/data.json',
        editurl: 'clientArray',
        datatype: "json",
        colModel: [
            {
                label: 'Customer ID',
                name: 'CustomerID',
                width: 75,
                key: true
            },
            {
                label: 'Company Name',
                name: 'CompanyName',
                width: 140,
                editable: true // must set editable to true if you want to make the field editable
            },
            {
                label : 'Phone',
                name: 'Phone',
                width: 100,
                editable: true
            },
            {
                label: 'Postal Code',
                name: 'PostalCode',
                width: 80,
                editable: true
            },
            {
                name: 'Country',
                width: 200,
                editable: true,
                edittype: "select",
                editoptions: {
                    value: "USA:USA;UK:UK;Canada:Canada"
                }
            },
            {
                name: 'City',
                width: 200,
                editable: true,
                edittype: "select",
                editoptions: {
                    value: "Select a City"
                }
            }
        ],
        loadonce: true,
        viewrecorde: true,
        width: 780,
        height: 200,
        rowNum: 10,
        pager: "#jqGridPager"
    });

    $('#jqGrid').navGrid('#jqGridPager',
        // the buttons to appear on the toolbar of the grid
        { edit: true, add: false, del: false, search: false, refresh: false, view: false, position: "left", cloneToTop: false },
        // options for the Edit Dialog
        {
            editCaption: "The Edit Dialog",
            recreateForm: true,
            closeAfterEdit: true,
            viewPagerButtons: false,
            afterShowForm: populateCities,
            errorTextFormat: function (data) {
                return 'Error: ' + data.responseText
            }
        },
        // options for the Add Dialog
        {
            closeAfterAdd: true,
            recreateForm: true,
            errorTextFormat: function (data) {
                return 'Error: ' + data.responseText
            }
        },
        // options for the Delete Dailog
        {
            errorTextFormat: function (data) {
                return 'Error: ' + data.responseText
            }
        });

    // This function gets called whenever an edit dialog is opened
    function populateCities() {
        // first of all update the city based on the country
        updateCityCallBack($("#Country").val(), true);
        // then hook the change event of the country dropdown so that it updates cities all the time
        $("#Country").bind("change", function (e) {
            updateCityCallBack($("#Country").val(), false);
        });
    }

    function updateCityCallBack(country, setselected) {
        var current = $("#jqGrid").jqGrid('getRowData',$("#jqGrid")[0].p.selrow).City;
        $("#City")
             .html("<option value=''>Loading cities...</option>")
             .attr("disabled", "disabled");

        $.ajax({
            url: country+".html",
            type: "GET",
            success: function (citiesHtml) {
                $("#City")
                     .removeAttr("disabled")
                     .html(citiesHtml);
                if(setselected) {
                    $("#City").val( current );
                }
            }
        });
    }

});

</script>







@endsection
