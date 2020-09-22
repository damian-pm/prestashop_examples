var translations = {
    filter: {
      byWord: function(input, rows){
        let word = $(input).val();
        if (word === '') {
          return rows;
        }
        return rows.filter(function(i,v){
            var res = false;
            $(v).find('.search-word-place').each(function(ind,val){
              if ($(val).val().indexOf(word) > -1) {
                res = true;
                return true;
              }
            });
          return res;
        });
      },
      byLang: function(selector, rows){
        let searchVal = $(selector).val();
        if (searchVal === '') {
          return rows;
        }
        return rows.filter(function(i,v){
          return (searchVal === $(v).find('.select-lang').val())
        });
      }
    },
    init: function(){
  
      $('.btn-toggle-card').on('click', function(){
        let box = $(this).data('box');
        $('.box-card').hide();
        $('#'+box).show();
      });
  
      $('#filter-lang').on('change', function(){
        let wordBox = $('#filter-word');
        let rows = $('.row-trans');
        rows.hide();
  
        rows = translations.filter.byLang($(this), rows);
        rows = translations.filter.byWord(wordBox, rows);
        rows.show();
      });
  
      $('#filter-word').on('keyup', function(){
        let langBox = $('#filter-lang');
        let wordBox = $('#filter-word');
        let rows = $('.row-trans');
        rows.hide();
        rows = translations.filter.byLang(langBox, rows);
        rows = translations.filter.byWord($(this), rows);
        rows.show();
      });
    }
  };
  
  translations.init();
  
  
  var translationAction = {
    send: function(url, data, callback){
      var modal = $('#myModal');
  
      $.ajax({
            url: url,
            type: "post",
            data: data || []
        })
        .done(function (response, textStatus, jqXHR){
            // Log a message to the console
            if (typeof callback === 'function') {
              callback(response, textStatus, jqXHR);
            }  
        })
        .fail(function (jqXHR, textStatus, errorThrown){
            // Log the error to the console
            console.error(
                "The following error occurred: "+
                textStatus, errorThrown
            );
        });
    },
    init: function(){
      $('.btn-modal-trans-add').on('click', function(){
        var modal = $('#myModal');
        let url = $(this).data('url');
  
        modal.data('url', url)
        translationAction.send(url, [], function(response){
          modal.find('.modal-body').html(response.html);
        });
        modal.modal('show')
      });
  
      $(document).on('click', '.tab_new_trans_save', function(e){
        e.preventDefault();
        var modal = $('#myModal');
        var url = modal.data('url');
        var data = modal.find('form').serializeArray();
  
        translationAction.send(url, data, function(response){
          modal.find('.modal-body').html(response.html);
        });
      });
  
      $('.btn-delete-translation').on('click', function(e){
        e.preventDefault();
        var btnDel = $(this)
        let url = btnDel.data('url');
        let id = btnDel.data('id');
        let modalYN = $('#yesNoModal');
        modalYN.data('url', url);
        modalYN.data('id', id);
        modalYN.modal('show');
      });
      $(document).on('click', '#yes-delete-trans', function(){
        let modalYN = $('#yesNoModal');
        let id = modalYN.data('id');
        let url = modalYN.data('url');
        let btnDel = $('.btn-delete-translation[data-id='+id+']');
        translationAction.send(url, {id: id}, function(response){
          if (response.status === 'ok') {
            btnDel.closest('tr').remove();
            modalYN.modal('hide');
          } else {
            console.error(response.status)
          }
        });
      })
  
    }
  };
  
  translationAction.init();  