$(function() {
  $.getJSON("getdata.php", function(data) {
      Morris.Area({
        element: 'morris-area-chart',
        data: data,
        xkey: 'a',
        ykeys: 'x',
        labels: 'Jumlah Pemasukan',
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: data,
        xkey: 'x',
        ykeys: 'a',
        labels: 'a',
        hideHover: 'auto',
        resize: true
    });
  });
});


// $(function() {
//   Morris.Area({
//     element: 'morris-area-chart',
//     data: [{"a":"0000000","x":"0000000"},{"a":"0000001","x":"0000001"},{"a":"0000002","x":"0000002"},{"a":"0000003","x":"0000003"}],
//     xkey: 'a',
//     ykeys: 'x',
//     labels: 'x',
//     pointSize: 2,
//     hideHover: 'auto',
//     resize: true
//   });
// });
