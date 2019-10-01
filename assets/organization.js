var arraydata = [];
function getorganizations() {
  arraydata = [];
  $('#spinsaveorganization').show();

  var cont = 0;
  $('#organization-to-edit li').each(function(index) {
    var dept = 0;
    for (var i = 0; i < $('#organization-to-edit li').length; i++) {
      var n = $(this)
        .attr('class')
        .indexOf('organization-item-depth-' + i);
      if (n != -1) {
        dept = i;
      }
    }
    var textoiner = $(this)
      .find('.item-edit')
      .text();
    var id = this.id.split('-');
    var textoexplotado = textoiner.split('|');
    var padre = 0;
    if (
      !!textoexplotado[textoexplotado.length - 2] &&
      textoexplotado[textoexplotado.length - 2] != id[2]
    ) {
      padre = textoexplotado[textoexplotado.length - 2];
    }
    arraydata.push({
      depth: dept,
      id: id[2],
      parent: padre,
      sort: cont
    });
    cont++;
  });
  updateitem();
  actualizarorganization();
}

function addcustomorganization() {
  $('#spincustomu').show();

  $.ajax({
    data: {
      labelorganization: $('#custom-organization-item-name').val(),
      linkorganization: $('#custom-organization-item-url').val(),
      roleorganization: $('#custom-organization-item-role').val(),
      idorganization: $('#idorganization').val()
    },

    url: addcustomorganizationr,
    type: 'POST',
    success: function(response) {
      window.location.reload();
    },
    complete: function() {
      $('#spincustomu').hide();
    }
  });
}

function updateitem(id = 0) {
  if (id) {
    var label = $('#idlabelorganization_' + id).val();
    var clases = $('#clases_organization_' + id).val();
    var url = $('#url_organization_' + id).val();
    var role_id = 0;
    if ($('#role_organization_' + id).length) {
      role_id = $('#role_organization_' + id).val();
    }

    var data = {
      label: label,
      clases: clases,
      url: url,
      role_id: role_id,
      id: id
    };
  } else {
    var arr_data = [];
    $('.organization-item-settings').each(function(k, v) {
      var id = $(this)
        .find('.edit-organization-item-id')
        .val();
      var label = $(this)
        .find('.edit-organization-item-title')
        .val();
      var clases = $(this)
        .find('.edit-organization-item-classes')
        .val();
      var url = $(this)
        .find('.edit-organization-item-url')
        .val();
      var role = $(this)
        .find('.edit-organization-item-role')
        .val();
      arr_data.push({
        id: id,
        label: label,
        class: clases,
        link: url,
        role_id: role
      });
    });

    var data = { arraydata: arr_data };
  }
  $.ajax({
    data: data,
    url: updateitemr,
    type: 'POST',
    beforeSend: function(xhr) {
      if (id) {
        $('#spincustomu2').show();
      }
    },
    success: function(response) {},
    complete: function() {
      if (id) {
        $('#spincustomu2').hide();
      }
    }
  });
}

function actualizarorganization() {
  $.ajax({
    dataType: 'json',
    data: {
      arraydata: arraydata,
      organizationname: $('#organization-name').val(),
      idorganization: $('#idorganization').val()
    },

    url: generateorganizationcontrolr,
    type: 'POST',
    beforeSend: function(xhr) {
      $('#spincustomu2').show();
    },
    success: function(response) {
      console.log('aqu llega');
    },
    complete: function() {
      $('#spincustomu2').hide();
    }
  });
}

function deleteitem(id) {
  $.ajax({
    dataType: 'json',
    data: {
      id: id
    },

    url: deleteitemorganizationr,
    type: 'POST',
    success: function(response) {}
  });
}

function deleteorganization() {
  var r = confirm('Do you want to delete this organization ?');
  if (r == true) {
    $.ajax({
      dataType: 'json',

      data: {
        id: $('#idorganization').val()
      },

      url: deleteorganizationgr,
      type: 'POST',
      beforeSend: function(xhr) {
        $('#spincustomu2').show();
      },
      success: function(response) {
        if (!response.error) {
          alert(response.resp);
          window.location = organizationwr;
        } else {
          alert(response.resp);
        }
      },
      complete: function() {
        $('#spincustomu2').hide();
      }
    });
  } else {
    return false;
  }
}

function createneworganization() {
  if (!!$('#organization-name').val()) {
    $.ajax({
      dataType: 'json',

      data: {
        organizationname: $('#organization-name').val()
      },

      url: createneworganizationr,
      type: 'POST',
      success: function(response) {
        window.location = organizationwr + '?organization=' + response.resp;
      }
    });
  } else {
    alert('Enter organization name!');
    $('#organization-name').focus();
    return false;
  }
}

function insertParam(key, value) {
  key = encodeURI(key);
  value = encodeURI(value);

  var kvp = document.location.search.substr(1).split('&');

  var i = kvp.length;
  var x;
  while (i--) {
    x = kvp[i].split('=');

    if (x[0] == key) {
      x[1] = value;
      kvp[i] = x.join('=');
      break;
    }
  }

  if (i < 0) {
    kvp[kvp.length] = [key, value].join('=');
  }

  //this will reload the page, it's likely better to store this until finished
  document.location.search = kvp.join('&');
}

wpNavOrganization.registerChange = function() {
  getorganizations();
};
