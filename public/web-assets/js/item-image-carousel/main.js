// Initialize product gallery

 
$('.show-small-img:first-of-type').css({'border': 'solid 1px #951b25', 'padding': '2px'})
$('.show-small-img:first-of-type').attr('alt', 'now').siblings().removeAttr('alt')
$('.show-small-img').click(function () {
  $('#show-img').attr('src', $(this).attr('src'))
  $('#big-img').attr('src', $(this).attr('src'))
  $(this).attr('alt', 'now').siblings().removeAttr('alt')
  $(this).css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
  if ($('#small-img-roll').children().length > 4) {
    if ($(this).index() >= 3 && $(this).index() < $('#small-img-roll').children().length - 1){
      $('#small-img-roll').css('left', -($(this).index() - 2) * 76 + 'px')
    } else if ($(this).index() == $('#small-img-roll').children().length - 1) {
      $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
    } else {
      $('#small-img-roll').css('left', '0')
    }
  }
})

//Enable the next button

$('#next-img').click(function (){
  $('#show-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
  $('#big-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
  $(".show-small-img[alt='now']").next().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
  $(".show-small-img[alt='now']").next().attr('alt', 'now').siblings().removeAttr('alt')
  if ($('#small-img-roll').children().length > 4) {
    if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
      $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
    } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
      $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
    } else {
      $('#small-img-roll').css('left', '0')
    }
  }
})

//Enable the previous button

$('#prev-img').click(function (){
  $('#show-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
  $('#big-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
  $(".show-small-img[alt='now']").prev().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
  $(".show-small-img[alt='now']").prev().attr('alt', 'now').siblings().removeAttr('alt')
  if ($('#small-img-roll').children().length > 4) {
    if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
      $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
    } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
      $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
    } else {
      $('#small-img-roll').css('left', '0')
    }
  }
})


// Initialize item gallery 

 
$('.show-small-img-item:first-of-type').css({'border': 'solid 1px #951b25', 'padding': '2px'})
$('.show-small-img-item:first-of-type').attr('alt', 'now').siblings().removeAttr('alt')
// $('.show-small-img-item').click(function () {
//   $('#show-img').attr('src', $(this).attr('src'))
//   $('#big-img').attr('src', $(this).attr('src'))
//   $(this).attr('alt', 'now').siblings().removeAttr('alt')
//   $(this).css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
//   if ($('#small-img-roll-item').children().length > 4) {
//     if ($(this).index() >= 3 && $(this).index() < $('#small-img-roll-item').children().length - 1){
//       $('#small-img-roll-item').css('left', -($(this).index() - 2) * 76 + 'px')
//     } else if ($(this).index() == $('#small-img-roll-item').children().length - 1) {
//       $('#small-img-roll-item').css('left', -($('#small-img-roll-item').children().length - 4) * 76 + 'px')
//     } else {
//       $('#small-img-roll-item').css('left', '0')
//     }
//   }
// })

//Enable the next button for next item

                // $('#next-img-item').click(function (){
                // console.log('test doang')
                // var jobs = JSON.parse("{{ json_encode($getsubscriptiondata['items']) }}");
                // $id = $(".show-small-img-item[alt='now']").next().attr('id')
                // console.log(jobs);
                // alert(jobs);
                // document.getElementsByClassName('item-details').style.display = 'none';
                
                // document.getElementsByClassName('item-details')[$id+1].style.display = 'block';
                // $('#show-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
                // $('#big-img').attr('src', $(".show-small-img[alt='now']").next().attr('src'))
                // $(".show-small-img[alt='now']").next().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
                // $(".show-small-img[alt='now']").next().attr('alt', 'now').siblings().removeAttr('alt')
                // if ($('#small-img-roll').children().length > 4) {
                //   if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
                //     $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
                //   } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
                //     $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
                //   } else {
                //     $('#small-img-roll').css('left', '0')
                //   }
                // }
                // })

//Enable the previous button for previous item

// $('#prev-img').click(function (){
//   $('#show-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
//   $('#big-img').attr('src', $(".show-small-img[alt='now']").prev().attr('src'))
//   $(".show-small-img[alt='now']").prev().css({'border': 'solid 1px #951b25', 'padding': '2px'}).siblings().css({'border': 'none', 'padding': '0'})
//   $(".show-small-img[alt='now']").prev().attr('alt', 'now').siblings().removeAttr('alt')
//   if ($('#small-img-roll').children().length > 4) {
//     if ($(".show-small-img[alt='now']").index() >= 3 && $(".show-small-img[alt='now']").index() < $('#small-img-roll').children().length - 1){
//       $('#small-img-roll').css('left', -($(".show-small-img[alt='now']").index() - 2) * 76 + 'px')
//     } else if ($(".show-small-img[alt='now']").index() == $('#small-img-roll').children().length - 1) {
//       $('#small-img-roll').css('left', -($('#small-img-roll').children().length - 4) * 76 + 'px')
//     } else {
//       $('#small-img-roll').css('left', '0')
//     }
//   }
// })
