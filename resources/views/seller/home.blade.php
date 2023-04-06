<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Items</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="/css/main.css" rel="stylesheet" />

</head>

<body>
    @if(session()->has('success'))
    <div class="alert alert-success ">
        {{ session('success') }}
        <a href="/post/home">Go see my product</a>
    </div>
    @endif

    @if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <section class="container-seller">
        <div class="container-mid">
            <img src="{{ asset('images/logo.png') }}" class="img-logo">
            <b>Add Items</b>
            
            <form action="/seller/postproduct" method="post" enctype="multipart/form-data" class="form-product">
                @csrf
                <input type="hidden" name="seller_id" id="seller_id" placeholder="seller_id" value="{{ Auth::user()->id }}"
                readonly>
                <div class="main-product">
                    <h1>Product Information</h1>
                    <div class="main-content">
                        <div class="wrap-content">
                            <div class="wrap-detail">
                                <label>Product Name</label>
                                <span>Required</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <input type="text" name="name_product" id="name_product">
                    </div>

                
                    <div class="main-content">
                        <div class="wrap-content">
                            <div class="wrap-detail">
                                <label>Description</label>
                                <span>Required</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <textarea type="text" name="description" id="description"></textarea>
                    </div>


                    <div class="main-content">
                        <div class="wrap-content">
                            <div class="wrap-detail">
                                <label>Stock</label>
                                <span>Required</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <input type="number" name="stock" id="stock" class="input-stock">
                    </div>

                   
                </div>


                <div class="main-product">
                    <h1>Pricing</h1>

                    <div class="main-content">
                        <div class="wrap-content">
                            <div class="wrap-detail">
                                <label>Subprice</label>
                                <span>Required</span>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <input type="number" name="subprice" id="subprice" class="input-stock">
                    </div>

                
                    <div class="main-content">
                        <div class="wrap-content">
                            <div class="wrap-detail">
                                <label>Discount</label>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <input type="number" name="discount" id="discount" class="input-stock" onblur="price_discount()">
                    </div>


                    <div class="main-content">
                        <div class="wrap-content">
                            <div class="wrap-detail">
                                <label>Cut-Price</label>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <label type="text" name="rp_discount" id="rp_discount" class="input-stock"></label>
                    </div>

                    <div class="main-content">
                        <div class="wrap-content">
                            <div class="wrap-detail">
                                <label>Price</label>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                        <input type="number" name="price" id="price" class="input-stock">
                    </div>

                   
                </div>

                <div class="main-product">
                    <h1>Product Photo</h1>
                    <div>
                        <input type="file" name="media" id="media" class="input-photo">
                        <div class="main-photo" id="display_media">
                        <i class="bi bi-folder-plus"></i>
                        </div>
                        
                    </div>
                </div>

                <div class="finish-product">
                    <a class="cancel-product" href="{{ url('pages/seller') }}/{{ Auth::user()->id }}">Cancel</a>
                    <button type="submit">Upload</button>
                </div>
        </form>
        </div>
    </section>
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

    <script>
        function price_discount(){
            var subprice = document.getElementById("subprice").value;
            var discount = document.getElementById("discount").value;
            var rp_discount = discount/100*subprice;
            document.getElementById("rp_discount").innerHTML = rp_discount;
            var price = subprice -rp_discount;
            document.getElementById("price").value = price;
        }
        const media_input = document.querySelector("#media");
        var uploaded = "";

        media_input.addEventListener("change", function(){
            const reader = new FileReader();
            reader.addEventListener("load", () => {
                uploaded = reader.result;
                document.querySelector("#display_media").style.backgroundImage = `url(${uploaded})`;
            });
            reader.readAsDataURL(this.files[0]);
        })
    </script>
</body>

</html>