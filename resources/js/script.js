
    function getSection(url){
        $.ajax({
            type: "GET",
            url: url,
            success: function (data) {
                $(".content-section").html(data);
                $('#select2').select2({
                    dropdownPosition: 'below'
                });
            },
        });
    }

    function doAction(url, method, entity){
        $.ajax({
            type: method,
            url: url,
            success : function(data){

            $(`.${entity}-message-alert`).html(data);
            $(`#${entity}-table`).DataTable().ajax.reload();

   
            }
        });
    }

    function padTo2Digits(num) {
        return num.toString().padStart(2, '0');
      }

    function formatDate(date) {
        return [
          padTo2Digits(date.getDate()),
          padTo2Digits(date.getMonth() + 1),
          date.getFullYear(),
        ].join('-') +" - "+ [
            padTo2Digits(date.getHours()),
            padTo2Digits(date.getMinutes())
          ].join(':');
      }

$(document).ready(function () {
    
    $.ajaxSetup({
        headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
     });
    

    //Home Page
    $("#home").on("click", function () {
        $.ajax({
            type: "GET",
            url: "/home",
            success: function (data) {
                $(".content-section").html(data);
            },
        });
    });

    //Account Page
    $("#account").on("click", function () {

        $.ajax({
            type: "GET",
            url: "/user/me",
            success: function (data) {

                $(".content-section").html(data);
            },
        });
    });

    //Companies Page
    $("#companies").on("click", function () {
        $.ajax({
            type: "GET",
            url: "/companiesList",
            success: function (data) {

                $(".content-section").html(data);
                $('#companies-table').DataTable({
                    "ajax": {
                        url: "/companies",
                        type: "GET",
                        dataSrc: 'data',
                    },
                    "columns": [
                        { data: null, render: data => `<a class="link" data-url="/companies/${data.id}">${data.name}</a>` },
                        {  data: 'description' },
                        { data: null, render: data => `<a class="action" data-entity="companies" data-method="DELETE" data-url="/company/${data.id}">Supprimer</a>`}
                        ]
                });
            },

        });
    });



    //Employees Page
    $("#employees").on("click", function () {
        $.ajax({
            type: "GET",
            url: "/employeesList",
            success: function (data) {

                $(".content-section").html(data);
                $('#employees-table').DataTable({
                    "ajax": {
                        url: "/employees",
                        type: "GET",
                    },
                    "columns": [
                        { data: null, render: data => `<a class="link" data-url="/employees/${data.id}">${data.name}</a>` },
                        {  data: 'email' },
                        {  data: null, render: data => `<a class="link" data-url="/companies/${data.company_id}">${data.company_name}</a>` },
                        {  data: 'address' },
                        {  data: 'phone' },
                        {  data: 'birthdate' },
                        {  data: null, render: data=> `<a class="action" data-entity="employees" data-method="DELETE" data-url="/employee/${data.id}">Supprimer</a>`}
                        ]
                });
            },
            
        });
    });


    //Invitation Page
    $("#invitations").on("click", function () {
        $.ajax({
            type: "GET",
            url: "/invitationsList",
            success: function (data) {

                $(".content-section").html(data);
                $('#invitations-table').DataTable({
                    "ajax": {
                        url: "/invitations",
                        type: "GET",
                    },
                    "columns": [
                        { data: null, render: data => `<a class="link" data-url='/employees/${data.employee_id}'>${data.employee_name}</a>` },
                        { data: null, render: data => `<a class="link" data-url='/user/${data.user_id}'>${data.user_name}<a/>`},
                        { data: null, render: data => `<a class="link" data-url='/companies/${data.company_id}'>${data.company_name}</a>` },
                        { data: null, render: data => {
                            const status = ['Acceptée', 'Envoyée', 'Annulée', 'Rejetée'];
                            const style = ['#7bb72e', '#f1bb33', '#f04242', '#9b9b9b'];

                            return `<span style='color:${style[status.indexOf(data.status)]}'>${data.status}</span>`;
                        } },
                        { data: null, render: data => (data.status != 'Acceptée' & data.status != 'Annulée') ? `<a class="action" data-entity="invitations" data-method="PUT" data-url="/invitation/${data.id}">Annuler</a>` : ''}
                        ]
                });
            },
            
        });
    });


    //Audit Page
    $("#audit").on("click", function () {
        $.ajax({
            type: "GET",
            url: "/audit",
            success: function (data) {

                $(".content-section").html(data);
                $('#audit-table').DataTable({
                    "ajax": {
                        url: "/audit",
                        type: "POST"
                    },
                    "columns": [
                        { data: null, render: data => `<strong>${formatDate(new Date(data.created_at))}:</strong> ${data.event}` },
                        ]
                });
            },
            
        });
    });


    ///Employee Pages
    $("#employee_home").on("click", function () {
        $.ajax({
            type: "GET",
            url: "/employeeHome",
            success: function (data) {
                $(".content-section").html(data);
            },
        });
    });

    //Account Page
    $("#employee_account").on("click", function () {

        $.ajax({
            type: "GET",
            url: "/employee/me",
            success: function (data) {
                $(".content-section").html(data);
            },
        });
    });

    //Companies Page
    $("#employee_company").on("click", function () {
        const company_id = $(this).parent().data('company');
        $.ajax({
            type: "GET",
            url: "/company/employee/"+company_id,
            success: function (data) {

                $(".content-section").html(data);

            },

        });
    });



    //Employees Page
    $("#employee_collegues").on("click", function () {
        console.log('ok');
        $.ajax({
            type: "GET",
            url: "/collegues/employee",
            success: function (data) {
                console.log('okok');
                $(".content-section").html(data);
                $('#collegues-table').DataTable({
                    "ajax": {
                        url: "/collegues/list/employee",
                        type: "GET",
                    },
                    "columns": [
                        { data: 'name' },
                        {  data: 'email' },
                        {  data: 'company_name'},
                        {  data: 'address' },
                        {  data: 'phone' },
                        {  data: 'birthdate' },
                       ]
                });
            },
            error: function(err){
                console.log(err);
            }
            
        });
    });


    //Actions
    ///Invite Employee
    $(document).on('click', '.invite-employee', function(){
        $.ajax({
            type: "GET",
            url: "/invitation",
            success: function(data){
                $(".content-section").html(data);
            }
        });
    });

    ///Create Company
    $(document).on('click', '.create-company', function(){
        $.ajax({
            type: "GET",
            url: "/company",
            success: function(data){
                $(".content-section").html(data);
            }
        });
    });

    ///Create User
    $(document).on('click', '.create-user', function(){
        $.ajax({
            type: "GET",
            url: "/user",
            success: function(data){
                $(".content-section").html(data);
            }
        });
    });





    //All

    //To execute link from table with class link
    $(document).on('click', '.link', function(){
        const url = $(this).data('url');
        getSection(url);
    });

    //To execute action from table with class link
    $(document).on('click', '.action', function(){
        const method = $(this).data('method');
        const url = $(this).data('url');
        const entity = $(this).data('entity');
        doAction(url, method, entity);
    });

    //To close alert message
    $(document).on('click', '.close', function(){
        $(this).closest('.alert').remove();
    });

    $(document).on('click', '.logout', function(){
        $.ajax({
            type: "POST",
            url: "/logout",
            success: function(data){
                window.location.href = data[1];
            }
        });
    });

    $(document).on('submit', 'form', function(event){
            event.preventDefault();
            const formData = $('form').serializeArray();
            // console.log(formData);
            const url = $('form').attr('action');
            const entity = $('form').data('entity');
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                success : function(data){
                    if(entity){
                        $(`.${entity}-message-alert`).html(data);
                    }

                    //invitation process
                    if(data[0] == 'newLocation'){
                        window.location.href = data[1];
                    }
                    
                },
                error: function (err) {

                    console.log(err);

                    function delay(ms) {
                        return new Promise(resolve => setTimeout(resolve, ms));
                      }
                      
                      $("span[id$='-error']").addClass('invalid-feedback');

                      delay(500).then(function(){
                        var errors = err.responseJSON.errors;
                        //hide all error messages

                        // Display the errors in the form.
                        $.each(errors, function (key, value) {

                            $(`#${key}-error`).html(value[0]);
                            $(`#${key}-error`).removeClass('invalid-feedback');
                            $(`#${key}-error`).addClass('feedback');

                        });

                      });

                    
                }
            });
            
    });











});
