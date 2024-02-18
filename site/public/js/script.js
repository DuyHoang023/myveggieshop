function openMenuMobile() {
  $(".menu-mb").width("250px");
  $(".btn-menu-mb").hide("fast");
}

function closeMenuMobile() {
  $(".menu-mb").width(0);
  $(".btn-menu-mb").show("fast");
}

function openCategoryMobile() {
  $(".category-mobile ul").show();
}

$(function () {

  //contact
  $(".form-contact").validate({
    rules: {
      // simple rule, converted to {required:true}
      fullname: {
        required: true,
        maxlength: 50,
        regex: /^[a-zA￾ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ\s]+$/i

      },
      // compound rule
      email: {
        required: true,
        email: true
      },
      mobile: {
        required: true,
        regex: /^0([0-9]{9,9})$/
      },
      content: {
        required: true
      }
    },

    messages: {
      fullname: {
        required: 'Vui lòng nhập họ và tên',
        maxlength: 'Vui lòng nhập không quá 50 ký tự',
        regex: 'Vui lòng nhập đúng họ và tên'
      },
      // compound rule
      mobile: {
        required: 'Vui lòng nhập số điện thoại',
        regex: 'Vui lòng nhập đúng định dạng số điện thoại.vd: 0932538468'

      },
      email: {
        required: 'Vui lòng nhập email',
        email: 'Vui lòng nhập đúng định dạng email. vd: abc@gmail.com'
      },
      content: {
        required: 'Vui lòng nhập nội dung'
      }
    },
    submitHandler: function (form) {
      // alert($(form).serialize());
      $('.message').html('<i class="fas fa-spinner fa-spin"></i> Hệ thống đang gởi mail, vui lòng chờ ...');
      $('.message').show();//display:block
      $.ajax({
        type: "POST",
        url: "?c=contact&a=sendEmail",
        data: $(form).serialize(),
        success: function (response) {
          $('.message').html(response);
          //reset form
          // form.reset();
        }
      });
    }
  });

  //Kiểm tra dữ liệu thỏa mãn mẫu hay không
  //Nếu không thì chuỗi Please check your input hiện ra
  $.validator.addMethod(
    "regex",
    function (value, element, regexp) {
      var re = new RegExp(regexp);
      return this.optional(element) || re.test(value);
    },
    "Please check your input."
  );


  // Tìm kiếm và sắp xếp sản phẩm
  $("#sort-select").change(function (event) {
    var fullURL = getUpdateParam("sort", $(this).val());
    window.location.href = fullURL;
  });

  // Tìm kiếm theo range
  $("main .price-range input").click(function () {
    var price_range = $(this).val();
    window.location.href = `?c=product&price-range=${price_range}`;
  });

  $("main .product-detail .product-detail-carousel-slider img").click(function (
    event
  ) {
    /* Act on the event */
    $("main .product-detail .main-image-thumbnail").attr(
      "src",
      $(this).attr("src")
    );
    var image_path = $("main .product-detail .main-image-thumbnail").attr(
      "src"
    );
    $(".zoomWindow").css("background-image", "url('" + image_path + "')");
  });

  // Display or hidden button back to top
  $(window).scroll(function () {
    if ($(this).scrollTop()) {
      $(".back-to-top").fadeIn();
    } else {
      $(".back-to-top").fadeOut();
    }
  });

  // Khi click vào button back to top, sẽ cuộn lên đầu trang web trong vòng 0.8s
  $(".back-to-top").click(function () {
    $("html").animate({ scrollTop: 0 }, 800);
  });

  // Hiển thị form đăng ký
  $(".btn-register").click(function () {
    $("#modal-login").modal("hide");
    $("#modal-register").modal("show");
  });

  // Hiển thị form đăng nhập
  $(".btn-login").click(function () {
    $("#modal-register").modal("hide");
    $("#modal-login").modal("show");
  });

  // Hiển thị form forgot password
  $(".btn-forgot-password").click(function () {
    $("#modal-login").modal("hide");
    $("#modal-forgot-password").modal("show");
  });

  // Carousel
  $(".owl-carousel").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    autoplay: true,
    responsive: {
      0: {
        items: 1,
      },
    },
  });
});

// Cập nhật giá trị của 1 param cụ thể
function getUpdateParam(k, v) {
  const fullUrl = window.location.href;
  const objUrl = new URL(fullUrl);
  objUrl.searchParams.set(k, v);
  return objUrl.toString();
}

function goToPage(page) {
  const newUrl = getUpdateParam('page', page);
  window.location.href = newUrl;
}
