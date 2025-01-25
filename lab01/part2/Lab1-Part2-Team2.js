$(document).ready(function () {
  //For Laptop Image
  $("#fade-out1").click(function () {
    $("#image1-fade").fadeOut();
  });
  $("#fade-in1").click(function () {
    $("#image1-fade").fadeIn();
  });

  //For Laptop Information
  $("#info-fade-out1").click(function () {
    $(".info-image1-fade").fadeOut();
  });
  $("#info-fade-in1").click(function () {
    $(".info-image1-fade").fadeIn();
  });


  //For Notebook Image 
  $("#fade-out2").click(function () {
    $("#image2-fade").fadeOut();
  });
  $("#fade-in2").click(function () {
    $("#image2-fade").fadeIn();
  });

  //For Notebook Information
  $("#info-fade-out2").click(function () {
    $(".info-image2-fade").fadeOut();
  });
  $("#info-fade-in2").click(function () {
    $(".info-image2-fade").fadeIn();
  });



  //For Tablet Image
  $("#fade-out3").click(function () {
    $("#image3-fade").fadeOut();
  });
  $("#fade-in3").click(function () {
    $("#image3-fade").fadeIn();
  });

  //For Tablet Information
  $("#info-fade-out3").click(function () {
    $(".info-image3-fade").fadeOut();
  });
  $("#info-fade-in3").click(function () {
    $(".info-image3-fade").fadeIn();
  });


  //For Phone Image
  $("#fade-out4").click(function () {
    $("#image4-fade").fadeOut();
  });
  $("#fade-in4").click(function () {
    $("#image4-fade").fadeIn();
  });

  //For Phone Information
  $("#info-fade-out4").click(function () {
    $(".info-image4-fade").fadeOut();
  });
  $("#info-fade-in4").click(function () {
    $(".info-image4-fade").fadeIn();
  });


  // For Title onHover
  $("#web-title").hover(function () {
    $(this).css({
      backgroundColor: "#DB7093",
      height: "60px",
      width: "30%",
    });
  }, function () {
    $(this).css({
      backgroundColor: "#FFB6C1",
      height: "50px",
      width: "25%",
    });
  })
  //For Buttons onHover

  //Image Fade In/Out Buttons
  for (let i = 1; i< 5; i++) {
    $(`#fade-in${i}`).hover(function () {
      $(this).css({
        backgroundColor: "#95B9C7",
        height: 30,
      });
    }, function () {
      $(this).css({
        backgroundColor: "cyan",
        height: 20,
      })
    });
    $(`#fade-out${i}`).hover(function () {
      $(this).css({
        backgroundColor: "#95B9C7",
        height: 30,
      });
    }, function () {
      $(this).css({
        backgroundColor: "cyan",
        height: 20,
      })
    });
  }
  
  //Info Fade In/Out Buttons and animate
  for (let i = 1; i < 5; i++) {
    $(`#info-fade-in${i}`).hover(function () {
      $(this).css({
        backgroundColor: "yellow",
        height: 30,
      });
    }, function () {
      $(this).css({
        backgroundColor: "greenyellow",
        height: 20,
      })
    });
    $(`#info-fade-out${i}`).hover(function () {
      $(this).css({
        backgroundColor: "yellow",
        height: 30,
      });
    }, function () {
      $(this).css({
        backgroundColor: "greenyellow",
        height: 20,
      })
    });
    $(`#animate${i}`).hover(function () {
      $(this).css({
        backgroundColor: "#F88379",
        height: 30,
      });
    }, function () {
      $(this).css({
        backgroundColor: "#FF3131",
        height: 20,
      })
    });
  }

  // Animations when Animate buttons are clicked
  for (let i = 1; i < 5; i++) {
    $(`#animate${i}`).click(function () {
      const element = $(`.info-image${i}-fade`);

      if (!element.data("switch")) {
        element.animate(
          {
            opacity: 1,
            fontSize: "24px",
            fontWeight: "bold",
          },
          500
        );
        element.data("switch", true);
      }
      else {
        element.animate(
          {
            opacity: 1,
            fontSize: "16px",
            fontWeight: "normal",
          },
          500
        );
        element.data("switch", false);
      }
    });
  }
});