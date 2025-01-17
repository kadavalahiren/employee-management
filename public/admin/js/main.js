$(document).ready(function () {
  var handleCheckboxes = function (html, rowIndex, colIndex, cellNode) {
    var $cellNode = $(cellNode);
    var $check = $cellNode.find(":checked");
    return $check.length
      ? $check.val() == 1
        ? "Yes"
        : "No"
      : $cellNode.text();
  };

  var activeSub = $(document).find(".active-sub");
  if (activeSub.length > 0) {
    activeSub.parent().show();
    activeSub.parent().parent().find(".arrow").addClass("open");
    activeSub.parent().parent().addClass("open");
  }
  window.dtDefaultOptions = {
    retrieve: true,
    dom: 'lBfrtip<"actions">',
    columnDefs: [],
    iDisplayLength: 10,
    aaSorting: [],
    buttons: [
//      {
//          extend: 'copy',
//          exportOptions: {
//              columns: ':visible',
//              format: {
//                  body: handleCheckboxes
//              }
//          }
//      },
//      {
//          extend: 'csv',
//          exportOptions: {
//              columns: ':visible',
//              format: {
//                  body: handleCheckboxes
//              }
//          }
//      },
//      {
//          extend: 'excel',
//          exportOptions: {
//              columns: ':visible',
//              format: {
//                  body: handleCheckboxes
//              }
//          }
//      },
//      {
//          extend: 'pdf',
//          exportOptions: {
//              columns: ':visible',
//              format: {
//                  body: handleCheckboxes
//              }
//          }
//      },
//      {
//          extend: 'print',
//          exportOptions: {
//              columns: ':visible',
//              format: {
//                  body: handleCheckboxes
//              }
//          }
//      },
      "colvis",
    ],
  };

  $(".datatable").each(function () {
    if ($(this).hasClass("dt-select")) {
      window.dtDefaultOptions.select = {
        style: "multi",
        selector: "td:first-child",
      };

      window.dtDefaultOptions.columnDefs.push({
          orderable: false,
          // className: 'select-checkbox',
          targets: 0
      });
    }
    $(this).dataTable(window.dtDefaultOptions);
  });

  if (typeof window.route_mass_crud_entries_destroy != "undefined") {
    $(".datatable, .ajaxTable")
      .siblings(".actions")
      .html(
        '<a href="' +
          window.route_mass_crud_entries_destroy +
          '" class="badge badge-pill badge-light-danger js-delete-selected delete-collumn" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>'
      );
  }

  $(document).on("click", ".js-delete-selected", function (e) {
    e.preventDefault();
    var self = this;
    //  Show SWAL alert message on click of delete multiple record

    var ids = [];
    //  find id of record and ajax call for delete
    $(self)
        .closest(".actions")
        .siblings(".datatable, .ajaxTable")
        .find("tbody tr.selected")
        .each(function () {
          console.log("selected", $(this).data("entry-id"));
          ids.push($(this).data("entry-id"));
        });

    if(ids.length == 0)
      return false;

    delte_confirm_text = (typeof delte_confirm_text !== 'undefined') ? delte_confirm_text:"Are you sure you want to delete this field?" ;
    swal({
      title: "",
      text: delte_confirm_text,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      // If confirm true on delete then ajax call perform
      if (willDelete) {
        var ids = [];
        //  find id of record and ajax call for delete
        $(self)
          .closest(".actions")
          .siblings(".datatable, .ajaxTable")
          .find("tbody tr.selected")
          .each(function () {
            console.log("selected", $(this).data("entry-id"));
            ids.push($(this).data("entry-id"));
          });

        $.ajax({
          method: "POST",
          url: $(self).attr("href"),
          data: {
            _token: _token,
            ids: ids,
          },
        }).done(function () {
          setTimeout(function () {
            swal("Deleted Successfully!").then(function () {
              location.reload();
            });
          }, 0);
          // location.reload();
        });
      }
    });
    return false;
  });

  $(document).on("click", ".delete-qty", function () {
    var self = this;
    //  Show SWAL alert message on click of delete multiple record
    delte_confirm_text = !delte_confirm_text
      ? "Are you sure"
      : delte_confirm_text;
    swal({
      title: "",
      text: delte_confirm_text,
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      // If confirm true on delete then ajax call perform
      if (willDelete) {
        var ids = [];
        //  find id of record and ajax call for delete
        $(self)
          .closest(".actions")
          .siblings(".datatable, .ajaxTable")
          .find("tbody tr.selected")
          .each(function () {
            console.log("selected", $(this).data("entry-id"));
            ids.push($(this).data("entry-id"));
          });
        if (ids.length == 0) {
          setTimeout(function () {
            swal("please select quantity unit").then(function () {});
          }, 0);
        } else {
          $.ajax({
            method: "POST",
            url: $(self).attr("href"),
            data: {
              _token: _token,
              ids: ids,
            },
            success: function (data) {
              if (data.sucess == false) {
                setTimeout(function () {
                  swal(data.message).then(function () {
                    location.reload();
                  });
                }, 0);
              } else {
                setTimeout(function () {
                  swal(data.message).then(function () {
                    location.reload();
                  });
                }, 0);
              }

              // successmessage = 'Data was succesfully captured';
            },
          }).done(function (success) {
            //
            // location.reload();
          });
        }
      }
    });
    return false;
  });

  $(document).on("click", "#select-all", function () {
    var selected = $(this).is(":checked");

    $(this)
      .closest("table.datatable, table.ajaxTable")
      .find("td:first-child")
      .each(function () {
        if (selected != $(this).closest("tr").hasClass("selected")) {
          $(this).click();
        }
      });
  });

  $(".mass").click(function () {
    if ($(this).is(":checked")) {
      $(".single").each(function () {
        if ($(this).is(":checked") == false) {
          $(this).click();
        }
      });
    } else {
      $(".single").each(function () {
        if ($(this).is(":checked") == true) {
          $(this).click();
        }
      });
    }
  });

  $(".page-sidebar").on("click", "li > a", function (e) {
    if (
      $("body").hasClass("page-sidebar-closed") &&
      $(this).parent("li").parent(".page-sidebar-menu").size() === 1
    ) {
      return;
    }

    var hasSubMenu = $(this).next().hasClass("sub-menu");

    if ($(this).next().hasClass("sub-menu always-open")) {
      return;
    }

    var parent = $(this).parent().parent();
    var the = $(this);
    var menu = $(".page-sidebar-menu");
    var sub = $(this).next();

    var autoScroll = menu.data("auto-scroll");
    var slideSpeed = parseInt(menu.data("slide-speed"));
    var keepExpand = menu.data("keep-expanded");

    if (keepExpand !== true) {
      parent
        .children("li.open")
        .children("a")
        .children(".arrow")
        .removeClass("open");
      parent
        .children("li.open")
        .children(".sub-menu:not(.always-open)")
        .slideUp(slideSpeed);
      parent.children("li.open").removeClass("open");
    }

    var slideOffeset = -200;

    if (sub.is(":visible")) {
      $(".arrow", $(this)).removeClass("open");
      $(this).parent().removeClass("open");
      sub.slideUp(slideSpeed, function () {
        if (
          autoScroll === true &&
          $("body").hasClass("page-sidebar-closed") === false
        ) {
          if ($("body").hasClass("page-sidebar-fixed")) {
            menu.slimScroll({
              scrollTo: the.position().top,
            });
          }
        }
      });
    } else if (hasSubMenu) {
      $(".arrow", $(this)).addClass("open");
      $(this).parent().addClass("open");
      sub.slideDown(slideSpeed, function () {
        if (
          autoScroll === true &&
          $("body").hasClass("page-sidebar-closed") === false
        ) {
          if ($("body").hasClass("page-sidebar-fixed")) {
            menu.slimScroll({
              scrollTo: the.position().top,
            });
          }
        }
      });
    }
    if (hasSubMenu == true || $(this).attr("href") == "#") {
      e.preventDefault();
    }
  });

  //$('.select2').select2();
});

function processAjaxTables() {
  $(".ajaxTable").each(function () {
    window.dtDefaultOptions.processing = true;
    window.dtDefaultOptions.serverSide = true;
    if ($(this).hasClass("dt-select")) {
      window.dtDefaultOptions.select = {
        style: "multi",
        selector: "td:first-child",
      };

      window.dtDefaultOptions.columnDefs.push({
        orderable: false,
        className: "select-checkbox",
        targets: 0,
      });
    }
    $(this).DataTable(window.dtDefaultOptions);
    if (typeof window.route_mass_crud_entries_destroy != "undefined") {
      $(this)
        .siblings(".actions")
        .html(
          '<a href="' +
            window.route_mass_crud_entries_destroy +
            '" class="badge badge-pill badge-light-danger js-delete-selected" style="margin-top:0.755em;margin-left: 20px;">Delete selected</a>'
        );
    }
  });
}

$(document).ready(function() {
  $('.datatable_new').DataTable( {
    "order": [[ 3, "desc" ]]
  } );
} );