document.getElementById('starRating').addEventListener('click', function (event) {
    var clickedStar = event.target;
    var rating = clickedStar.getAttribute('data-rating');

    document.getElementById('selectedRating').value = rating;

    var stars = document.querySelectorAll('.rating span');
    stars.forEach(function (star) {
        var starRating = star.getAttribute('data-rating');
        star.style.color = starRating <= rating ? '#ffca08' : '#aaa';
    });
});