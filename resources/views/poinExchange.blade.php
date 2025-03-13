<x-navbar />

<div class="container mt-5">
    <h1 class="text-center text-primary mb-4">TUKAR POIN MU DISINI!</h1>
    
    <div class="card mb-4">
        <div class="card-body text-center">
            <h3>Poin MU</h3>
            <h1 class="display-3 text-success">{{ user.points }}</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="/images/merch1.jpg" class="card-img-top" alt="Merchandise 1">
                <div class="card-body text-center">
                    <h5 class="card-title">Merchandise 1</h5>
                    <p class="card-text">500 Poin</p>
                    <button class="btn btn-success">Tukar</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="/images/merch2.jpg" class="card-img-top" alt="Merchandise 2">
                <div class="card-body text-center">
                    <h5 class="card-title">Merchandise 2</h5>
                    <p class="card-text">700 Poin</p>
                    <button class="btn btn-success">Tukar</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="/images/merch3.jpg" class="card-img-top" alt="Merchandise 3">
                <div class="card-body text-center">
                    <h5 class="card-title">Merchandise 3</h5>
                    <p class="card-text">1000 Points</p>
                    <button class="btn btn-success">Tukar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<x-footer />