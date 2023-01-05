
export function getSection(url){
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

export function doAction(url, method, entity){
    $.ajax({
        type: method,
        url: url,
        success : function(data){

        $(`.${entity}-message-alert`).html(data);
        $(`#${entity}-table`).DataTable().ajax.reload();


        }
    });
}

export function padTo2Digits(num) {
    return num.toString().padStart(2, '0');
}

    
export function formatDate(date) {
    return [
        padTo2Digits(date.getDate()),
        padTo2Digits(date.getMonth() + 1),
        date.getFullYear(),
    ].join('-') +" - "+ [
        padTo2Digits(date.getHours()),
        padTo2Digits(date.getMinutes())
        ].join(':');
}


export function delay(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
  }