<div class="search-result__list">
    <div class="js-total search-result__total">
        Total:
    </div>

    <form action="/" class="search-form search-form-email">
        <div class="search-form__wrap form-group">
            <input type="email" class="search-form__input form-control" name="q" id="q" placeholder="Enter Email Address">
            <button type="submit" class="btn btn-primary search-form__btn search-form__btn_email"></button>
        </div>
    </form>

    <div class="search-result__sorting">
        <button type="button" class="search-result__sorting-btn --up"></button>
        <button type="button" class="search-result__sorting-btn --down"></button>
    </div>

    <div class="js-results"></div>
    <div class="js-simple-search-result simple-search-result search-result__item">
        <div class="search-result__avatar"></div>
        <div class="search-result__item-body">
            <div class="address"></div>
            <div class="legal1"></div>
        </div>
        <div class="search-result__actions">
            <span class="search-result__action --check"></span>
            <span class="search-result__action --save"></span>
        </div>
    </div>

    <div class="popup js-popup">
        <div class="popup__body">
            <div class="popup__content js-popup-content">
                <h3 class="popup__title">Property info</h3>
                <div class="popup__wrap">
                    <div class="popup__photo"><img src="{{url('/images/pic.png')}}" alt=""></div>
                    <div class="popup__map"><img src="{{url('/images/map.png')}}" alt=""></div>
                </div>
                <div class="popup__btn-wrap">
                    <button type="button" class="popup__btn popup__btn-secondary js-popup-close">Close</button>               
                    <button type="button" class="popup__btn popup__btn-primary">Save property</button>               
                </div>
            </div>
            <span class="popup__close js-popup-close"></span>
        </div>
    </div>

</div>