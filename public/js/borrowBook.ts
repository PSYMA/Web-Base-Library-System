if ($("#borrowBookPage").length) {
    let selected_books_id = [];
    let array = window.globalThis.array;
    let total: number = 0;

     
    
    window.onbeforeunload = function () {
        // store temporary selected books here
    }

    function displayBooks(books) {
        $(".book_list > tbody").empty();
        for (let i = 0; i < books.length; i++) {
            let b1 = books[i];
            $(".book_list > tbody").each(function () {
                $("<tr/>", {
                    appendTo: this,
                    function() {
                        let status = "";
                        if (b1.stacks != 0) status = "AVAILABLE";
                        else status = "N/A";
                        $("<td/>", {
                            class: "text-center",
                            text: b1.id,
                            appendTo: this
                        });
                        $("<td/>", {
                            class: "text-center",
                            text: b1.title,
                            appendTo: this
                        });
                        $("<td/>", {
                            class: "text-center",
                            text: b1.author,
                            appendTo: this
                        });
                        $("<td/>", {
                            class: "text-center",
                            text: b1.price,
                            appendTo: this
                        });
                        $("<td/>", {
                            class: "text-center",
                            text: b1.stacks,
                            appendTo: this
                        });
                        $("<td/>", {
                            class: "text-center",
                            text: status,
                            appendTo: this
                        });
                        if (b1.stacks != 0) {
                            $("<td/>", {
                                class: "text-center",
                                appendTo: this,
                                function() {
                                    $("<button/>", {
                                        id: b1.id,
                                        class: "btn btn-secondary",
                                        text: "Select",
                                        style: "width: 80px",
                                        appendTo: this,
                                        function() {
                                            $(this).on("click", function () {
                                                let c1 = this.className;
                                                let c2 = "btn btn-secondary";
                                                if (c1 == c2) {
                                                    $(this).html("Selected");
                                                    this.className = "btn btn-success";
                                                    selected_books_id.push(this.id);
                                                    $.ajax({
                                                        url: "/addToCart",
                                                        data: {
                                                            selected_books_id: selected_books_id
                                                        },
                                                        type: "GET",
                                                        cache: false,
                                                        success: function (books) { }
                                                    });
                                                } else {
                                                    $(this).html("Select");
                                                    this.className = "btn btn-secondary";
                                                    selected_books_id.splice(selected_books_id.indexOf(this.id), 1);
                                                    $.ajax({
                                                        url: "/removeToCart",
                                                        data: {
                                                            book: this.id
                                                        },
                                                        type: "GET",
                                                        cache: false,
                                                        success: function (books) { }
                                                    });
                                                }
                                            });
                                        }
                                    });
                                }
                            });
                        }
                    }
                });
            });
        }
    }
    function checkSelectedBook(books) {
        for (let i = 0; i < books.length; i++) {
            for (let j = 0; j < array.data.length; j++) {
                let b1 = books[i];
                let b2 = array.data[j].id;
                if (b1 == b2) {
                    $("#" + b1).html("Selected");
                    $("#" + b1).attr("class", "btn btn-success");
                }
            }
        }
    }
    function displaySelectedBooks(books) {
        $(".insert_books > tbody").empty();
        total = 0;
        for (let i = 0; i < books.length; i++) {
            let b1 = books[i];
            total += parseFloat(b1.price);
            total = parseFloat(total.toFixed(2));
            $(".insert_books > tbody").each(function () {
                $("<tr/>", {
                    appendTo: this,
                    function() {
                        $("<td/>", {
                            class: "text-center",
                            text: b1.id,
                            appendTo: this
                        });
                        $("<td/>", {
                            class: "text-center",
                            text: b1.title,
                            appendTo: this
                        });
                        $("<td/>", {
                            class: "text-center",
                            text: b1.author,
                            appendTo: this
                        });
                        $("<td/>", {
                            class: "text-center",
                            text: b1.price,
                            appendTo: this
                        });
                        $("<td/>", {
                            class: "text-center",
                            appendTo: this,
                            function() {
                                $("<button/>", {
                                    class: "btn btn-danger",
                                    text: "Remove",
                                    appendTo: this,
                                    function() {
                                        $(this).on("click", function () {
                                            $(".insert_books > tbody").empty();
                                            let arr = [];
                                            $.ajax({
                                                url: "/removeToCart",
                                                data: {
                                                    book: b1.id
                                                },
                                                type: "GET",
                                                cache: false,
                                                success: function (books) {
                                                    selected_books_id = books;
                                                    $.ajax({
                                                        url: "/getSelectedBook",
                                                        data: {
                                                            selected_books_id: selected_books_id
                                                        },
                                                        type: "GET",
                                                        cache: false,
                                                        success: function (books) {
                                                            for (let i = 0; i < books.length; i++) {
                                                                arr.push(books[i].id);
                                                            }
                                                            displayBooks(array.data);
                                                            checkSelectedBook(arr);
                                                            displaySelectedBooks(books);
                                                            selected_books_id = arr;
                                                         }
                                                    });
                                                }
                                            });

                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            })
        }
        $('#total_payment').html(total.toString());
    }
    $.ajax({
        url: "/addToCart",
        data: {
            selected_books_id: selected_books_id
        },
        type: "GET",
        cache: false,
        success: function (books) {
            displayBooks(array.data);
            checkSelectedBook(books);
            if (books.length) selected_books_id = books;
        }
    });

    displayBooks(array.data);
    $(".modal_count_book_btn").on("click", function () {
        selected_books_id.sort();
        $.ajax({
            url: "/getSelectedBook",
            data: {
                selected_books_id: selected_books_id
            },
            type: "GET",
            cache: false,
            success: function (books) {
                displaySelectedBooks(books);
            }
        });
    });
    $("input#search").bind("keyup", function () {
        if ($(this).val() === "") {
            $("#links").show();
            displayBooks(array.data);
        } else {
            const searchResult = $(this).val();
            $.ajax({
                url: "/library/book/searchBook",
                data: {
                    search_result: searchResult
                },
                type: "GET",
                cache: false,
                success: function (books) {
                    if (books.length) {
                        $(".book_list tbody").empty();
                        $("#links").hide();
                        displayBooks(books);
                    }
                }
            });
        }
    });
    $("input#amount").bind("keyup", function () {
        if ($("input#amount").val() >= total && total != 0) {
            $("#pay_price").prop("disabled", false);
        } else {
            $("#pay_price").prop("disabled", true);
        }
    });
    $('#pay_price').on('click', function () {
        // store array of selected books in database
        if ($('input#amount').val() != "") {
            selected_books_id.sort();
            for (let i = 0; i < selected_books_id.length; i++) {
                let value = selected_books_id[i];
                $('#pay_form').append(
                    ' <input type="hidden" name="selected_books_id[]" id="selected_books_id" value="' +
                    value + '">');
            }
        }
    })
}