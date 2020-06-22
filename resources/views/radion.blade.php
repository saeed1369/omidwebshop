

                    <!-- form start -->
                    <form role="form" class="form-edit-add" action="http://shop-laravel.com//products/save2" method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->

                        <!-- CSRF TOKEN -->
                        @csrf



                            <div class="col-md-12 ">

                                @include('filters')
                            </div>


                        <div class="panel-footer">
                            <button type="submit" class="btn btn-danger save">ذخیره</button>
                        </div>
                    </form>




