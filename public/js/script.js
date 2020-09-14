window.onload = () => {
    makeIntersectionObserver('.lazy-load', {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    }, function (target) {
        const lazyImg = target
        lazyImg.attr('src', lazyImg.attr('data-src'));
    })

    makeIntersectionObserver('.viewed-products', {
        root: null,
        rootMargin: '300px',
        threshold: 0.1
    }, function (target) {
        let url = target.attr('data-api-url') + '?sleep=5';
        $.ajax(url)
            .done(function(responseJson) {
                let blok = target.find('.row');
                target.prepend('<h1>Viewed Products</h1>');
                responseJson.forEach(function (item) {
                    let card = `
                        <div class="col mb-4">
                            <div class="card h-100">
                                <img src="${item.image}" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">${item.title}</h5>
                                    <p class="card-text">${item.text}</p>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text"><a href="#" class="btn btn-primary">Buy now!</a></p>
                                </div>
                            </div>
                        </div>
                    `;

                    blok.append(card);
                });
            })

    })
}

function makeIntersectionObserver(selector, options, callback) {
        const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                callback($(entry.target))
                observer.unobserve(entry.target)
            }
        })
    }, options)

    $(selector).each(function( index ) {
        observer.observe($(this).get(0))
    });
}
