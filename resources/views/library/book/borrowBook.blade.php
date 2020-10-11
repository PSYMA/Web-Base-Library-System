@extends('layouts.app')

@section('content')
    <div class="container" id="borrowBookPage">
        <div class="btn-group float-right">
            <input class="text-center btn btn-default border-dark mr-2" type="text" id="search" name="search"
                placeholder="Search book">
            <button class="btn btn-info modal_count_book_btn border-dark " data-toggle="modal"
                data-target="#selected_book_modal">
                Selected Book(s)
            </button>
        </div>

        <!-- Modal Seletect Books-->
        <div class="modal fade" id="selected_book_modal" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Selected Book(s)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <section class="table-responsive tableFixHead">
                            <table class="table table-bordered insert_books">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">ID</th>
                                        <th class="text-center" scope="col">Title</th>
                                        <th class="text-center" scope="col">Author</th>
                                        <th class="text-center" scope="col">Price</th>
                                        <th class="text-center" scope="col">Quantities</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </section>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- Button trigger payment modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#payment_modal">
                            Borrow
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Pay-->
        <div class="modal fade" id="payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Payment(s)</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="pay_form" action="{{ route('library.user.update', Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input name="amount" id="amount" type="number" class="form-control" required min="0"
                                    step="0.01" pattern="^\d+(?:\.\d{1,2})?$"> </div>
                            <div class="form-group">
                                <button id="total_payment" type="submit" class="btn btn-success btn-block"
                                    disabled></button>
                            </div>
                            <div class="form-group">
                                <button id="pay_price" type="submit" class="btn btn-primary btn-block" disabled> Pay >>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive tableFixHead">
            <table class="table table-bordered book_list">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Title</th>
                        <th class="text-center" scope="col">Author</th>
                        <th class="text-center" scope="col">Price</th>
                        <th class="text-center" scope="col">Stacks</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
        <div id="links">
            {{ $books->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <script type="application/javascript" defer>
        if ($('#borrowBookPage').length) {
            var array = @json($books);
        }

    </script>
    <script src="{{ asset('js/borrowBook.js') }}" defer></script>
@endsection
