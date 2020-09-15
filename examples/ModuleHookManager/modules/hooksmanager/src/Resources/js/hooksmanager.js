/**
 * Hooks events
 */
$(document)
    .on('click', "#table-hook-list .btn-edit", function(){
        console.log('edit', this);
        let hookId = $(this).closest('tr').find('.hook-id').text();
        let url = $('#hooksmanager-box').data('url');
        let address = url.split('&id=')[0];
        window.location.replace(address + '&type=edit&id=' + hookId);
    })
    .on('click', "#table-hook-list .btn-del", function(){

        let box = $(this).closest('tr');
        let id = box.find('.hook-id').text();
        let url = $('#hooksmanager-box').data('urldel');
        let boxAlert = $('#box-alert');

        $.post(url, {id:id}, function(data, status){
            if (status === 'success') {
                box.remove();
                boxAlert.append('<div class="alert alert-success" role="alert">Hook removed</div>')
            } else {
                boxAlert.append('<div class="alert alert-danger" role="alert">Hook error, somethind went wrong</div>')
            }
        });
    })
    .on('keyup', "#search-hook-list", function(){
        let searchWord = $(this).val();
        $('.hook-row').each(function(){
            let hookName = $(this).find('.hook-name').text();
            let hookDesc = $(this).find('.hook-description').text();
            let hookTitle = $(this).find('.hook-title').text();
            let row = $(this)
            if (hookName.indexOf(searchWord) >= 0 ||
                hookDesc.indexOf(searchWord) >= 0 ||
                hookTitle.indexOf(searchWord) >= 0) {
                row.show()
            } else {
                row.hide()
            }
        });
    });