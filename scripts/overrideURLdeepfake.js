$(document).ready(function() {
  const imgSource = $('#profilepic').attr("src");
  const videoSource = imgSource.substr(0, imgSource.lastIndexOf('.')) + "-video.mp4";
  $('#resurrect').on('click', function() {
    changeElement(imgSource, videoSource);
  })
})

const changeElement = (imgSource, videoSource) => {
    if ($('#profilepic').length) {
      let fake = document.createElement('video');
      fake.setAttribute("id", "deepfake");
      fake.setAttribute("src", videoSource);
      fake.setAttribute("autoplay", "true");
      fake.setAttribute("loop", "true");
      fake.classList.add('rounded-circle', 'shadow-lg', 'p-1', 'mb-3', 'mt-3', 'bg-warning', 'rounded');

      $("#profilepic").replaceWith(fake);
    }
    else if ($('#deepfake').length) {
      let image = document.createElement('img');
      image.setAttribute("id", "profilepic");
      image.setAttribute("src", imgSource);
      image.classList.add('rounded-circle', 'shadow-lg', 'p-1', 'mb-3', 'mt-3', 'bg-warning', 'rounded');

      $("#deepfake").replaceWith(image);
    }
}
