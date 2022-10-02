describe("Store employee spec", () => {
    it("Admin can access employee CRUD page", () => {
        // admin melakukan login
        cy.visit("/login");

        cy.get("[data-id=field-email]").type("admin@mail.com");
        cy.get("[data-id=field-password]").type("12345678");
        cy.get("[data-id=btn-signin]").click();

        // admin mengakses laman admin/employee
        cy.visit("admin/employee");

        // laman admin/employee
        cy.get("[data-id=title]").should("have.text", "Employees Table");
        cy.get("[data-id=btn-input-emp").contains("Input Employee");
        cy.get("[data-id=tb-employee]").contains("th", "Employee Id");
        cy.get("[data-id=tb-employee]").contains("th", "User Id");
        cy.get("[data-id=tb-employee]").contains("th", "Role");
        cy.get("[data-id=tb-employee]").contains("th", "Name");
        cy.get("[data-id=tb-employee]").contains("th", "Action");
    });

    it("Admin can input new employee", () => {
        // admin melakukan login
        cy.visit("/login");

        cy.get("[data-id=field-email]").type("admin@mail.com");
        cy.get("[data-id=field-password]").type("12345678");
        cy.get("[data-id=btn-signin]").click();

        // admin mengakses laman admin/employee
        cy.visit("admin/employee");

        // admin klik tombol input employee
        cy.get("[data-id=btn-input-emp").click();

        // admin redirected to admin/employee/create
        // admin fill the fields
        cy.get("[data-id=name-field]").type("Name for testing", {
            force: true,
        });
        cy.get("[data-id=email-field]").type("testinsssg@mail.com", {
            force: true,
        });
        cy.get("[data-id=password-field").type("12345678", { force: true });
        cy.get("[data-id=role-select").select("Kasir");
        cy.get("[data-id=date-field]").type("2022-09-30");
        cy.get("[data-id=address-field]").type("Address for testing", {
            force: true,
        });
        cy.get("[data-id=phone-field]").type("1234567890", { force: true });
        cy.get("[data-id=gender-select]").select("Male");
        cy.get("[data-id=btn-submit]").click();

        // admin redirected to admin/employee
        cy.get("[data-id=success-message]").should(
            "have.text",
            "Employee Added Successfully"
        );
    });

    it("Test all field is required", () => {
        // admin melakukan login
        cy.visit("/login");

        cy.get("[data-id=field-email]").type("admin@mail.com");
        cy.get("[data-id=field-password]").type("12345678");
        cy.get("[data-id=btn-signin]").click();

        // admin mengakses laman admin/employee
        cy.visit("admin/employee");

        // admin klik tombol input employee
        cy.get("[data-id=btn-input-emp").click();

        // admin klik tombol sumbit tanpa mengisi form
        cy.get("[data-id=btn-submit]").click();

        // laman menampilkan pesan error
        cy.get("[data-id=list-errors]").contains(
            "li",
            "The name field is required."
        );
        cy.get("[data-id=list-errors]").contains(
            "li",
            "The email field is required."
        );
        cy.get("[data-id=list-errors]").contains(
            "li",
            "The password field is required."
        );
        cy.get("[data-id=list-errors]").contains(
            "li",
            "The date of birth field is required."
        );
        cy.get("[data-id=list-errors]").contains(
            "li",
            "The address field is required."
        );
        cy.get("[data-id=list-errors]").contains(
            "li",
            "The phone field is required."
        );
    });

    it("name less than three characters", () => {
        // admin melakukan login
        cy.visit("/login");

        cy.get("[data-id=field-email]").type("admin@mail.com");
        cy.get("[data-id=field-password]").type("12345678");
        cy.get("[data-id=btn-signin]").click();

        // admin mengakses laman admin/employee
        cy.visit("admin/employee");

        // admin klik tombol input employee
        cy.get("[data-id=btn-input-emp").click();

        // admin redirected to admin/employee/create
        // admin fill the fields
        cy.get("[data-id=name-field]").type("A", {
            force: true,
        });
        cy.get("[data-id=email-field]").type("testing@mail.com", {
            force: true,
        });
        cy.get("[data-id=password-field").type("12345678", { force: true });
        cy.get("[data-id=role-select").select("Kasir");
        cy.get("[data-id=date-field]").type("2022-09-30");
        cy.get("[data-id=address-field]").type("Address for testing", {
            force: true,
        });
        cy.get("[data-id=phone-field]").type("1234567890", { force: true });
        cy.get("[data-id=gender-select]").select("Male");
        cy.get("[data-id=btn-submit]").click();

        cy.get("[data-id=list-errors]").contains(
            "li",
            "The name must be at least 3 characters."
        );
    });

    it("name more than fifty characters", () => {
        // admin melakukan login
        cy.visit("/login");

        cy.get("[data-id=field-email]").type("admin@mail.com");
        cy.get("[data-id=field-password]").type("12345678");
        cy.get("[data-id=btn-signin]").click();

        // admin mengakses laman admin/employee
        cy.visit("admin/employee");

        // admin klik tombol input employee
        cy.get("[data-id=btn-input-emp").click();

        // admin redirected to admin/employee/create
        // admin fill the fields
        cy.get("[data-id=name-field]").type(
            "kata ini lebih dari lima puluh karakter, satu dua tiga empat lima enam tuju delapan sembilan sepuluh testing testing",
            {
                force: true,
            }
        );
        cy.get("[data-id=email-field]").type("testings@mail.com", {
            force: true,
        });
        cy.get("[data-id=password-field").type("12345678", { force: true });
        cy.get("[data-id=role-select").select("Kasir");
        cy.get("[data-id=date-field]").type("2022-09-30");
        cy.get("[data-id=address-field]").type("Address for testing", {
            force: true,
        });
        cy.get("[data-id=phone-field]").type("1234567890", { force: true });
        cy.get("[data-id=gender-select]").select("Male");
        cy.get("[data-id=btn-submit]").click();

        cy.get("[data-id=list-errors]").contains(
            "li",
            "The name must not be greater than 50 characters."
        );
    });

    it("password less than eight characters", () => {
        // admin melakukan login
        cy.visit("/login");

        cy.get("[data-id=field-email]").type("admin@mail.com");
        cy.get("[data-id=field-password]").type("12345678");
        cy.get("[data-id=btn-signin]").click();

        // admin mengakses laman admin/employee
        cy.visit("admin/employee");

        // admin klik tombol input employee
        cy.get("[data-id=btn-input-emp").click();

        // admin redirected to admin/employee/create
        // admin fill the fields
        cy.get("[data-id=name-field]").type("Nama for testing", {
            force: true,
        });
        cy.get("[data-id=email-field]").type("testingggg@mail.com", {
            force: true,
        });
        cy.get("[data-id=password-field").type("123", { force: true });
        cy.get("[data-id=role-select").select("Kasir");
        cy.get("[data-id=date-field]").type("2022-09-30");
        cy.get("[data-id=address-field]").type("Address for testing", {
            force: true,
        });
        cy.get("[data-id=phone-field]").type("1234567890", { force: true });
        cy.get("[data-id=gender-select]").select("Male");
        cy.get("[data-id=btn-submit]").click();

        cy.get("[data-id=list-errors]").contains(
            "li",
            "The password must be at least 8 characters."
        );
    });

    it("password more than fifty characters", () => {
        // admin melakukan login
        cy.visit("/login");

        cy.get("[data-id=field-email]").type("admin@mail.com");
        cy.get("[data-id=field-password]").type("12345678");
        cy.get("[data-id=btn-signin]").click();

        // admin mengakses laman admin/employee
        cy.visit("admin/employee");

        // admin klik tombol input employee
        cy.get("[data-id=btn-input-emp").click();

        // admin redirected to admin/employee/create
        // admin fill the fields
        cy.get("[data-id=name-field]").type("Nama for testing", {
            force: true,
        });
        cy.get("[data-id=email-field]").type("testings@mail.com", {
            force: true,
        });
        cy.get("[data-id=password-field").type(
            "kata ini lebih dari lima puluh karakter, satu dua tiga empat lima enam tuju delapan sembilan sepuluh testing testing",
            { force: true }
        );
        cy.get("[data-id=role-select").select("Kasir");
        cy.get("[data-id=date-field]").type("2022-09-30");
        cy.get("[data-id=address-field]").type("Address for testing", {
            force: true,
        });
        cy.get("[data-id=phone-field]").type("1234567890", { force: true });
        cy.get("[data-id=gender-select]").select("Male");
        cy.get("[data-id=btn-submit]").click();

        cy.get("[data-id=list-errors]").contains(
            "li",
            "The password must not be greater than 50 characters."
        );
    });

    it("address less than three characters", () => {
        // admin melakukan login
        cy.visit("/login");

        cy.get("[data-id=field-email]").type("admin@mail.com");
        cy.get("[data-id=field-password]").type("12345678");
        cy.get("[data-id=btn-signin]").click();

        // admin mengakses laman admin/employee
        cy.visit("admin/employee");

        // admin klik tombol input employee
        cy.get("[data-id=btn-input-emp").click();

        // admin redirected to admin/employee/create
        // admin fill the fields
        cy.get("[data-id=name-field]").type("Nama for testing", {
            force: true,
        });
        cy.get("[data-id=email-field]").type("testingggg@mail.com", {
            force: true,
        });
        cy.get("[data-id=password-field").type("1234567890", { force: true });
        cy.get("[data-id=role-select").select("Kasir");
        cy.get("[data-id=date-field]").type("2022-09-30");
        cy.get("[data-id=address-field]").type("A", {
            force: true,
        });
        cy.get("[data-id=phone-field]").type("1234567890", { force: true });
        cy.get("[data-id=gender-select]").select("Male");
        cy.get("[data-id=btn-submit]").click();

        cy.get("[data-id=list-errors]").contains(
            "li",
            "The address must be at least 3 characters."
        );
    });

    it("address more than fifty characters", () => {
        // admin melakukan login
        cy.visit("/login");

        cy.get("[data-id=field-email]").type("admin@mail.com");
        cy.get("[data-id=field-password]").type("12345678");
        cy.get("[data-id=btn-signin]").click();

        // admin mengakses laman admin/employee
        cy.visit("admin/employee");

        // admin klik tombol input employee
        cy.get("[data-id=btn-input-emp").click();

        // admin redirected to admin/employee/create
        // admin fill the fields
        cy.get("[data-id=name-field]").type("Nama for testing", {
            force: true,
        });
        cy.get("[data-id=email-field]").type("testingggg@mail.com", {
            force: true,
        });
        cy.get("[data-id=password-field").type("1234567890", { force: true });
        cy.get("[data-id=role-select").select("Kasir");
        cy.get("[data-id=date-field]").type("2022-09-30");
        cy.get("[data-id=address-field]").type(
            "kata ini lebih dari lima puluh karakter, satu dua tiga empat lima enam tuju delapan sembilan sepuluh testing testing",
            {
                force: true,
            }
        );
        cy.get("[data-id=phone-field]").type("1234567890", { force: true });
        cy.get("[data-id=gender-select]").select("Male");
        cy.get("[data-id=btn-submit]").click();

        cy.get("[data-id=list-errors]").contains(
            "li",
            "The address must not be greater than 50 characters."
        );
    });

    it("phone less than 10 characters", () => {
        // admin melakukan login
        cy.visit("/login");

        cy.get("[data-id=field-email]").type("admin@mail.com");
        cy.get("[data-id=field-password]").type("12345678");
        cy.get("[data-id=btn-signin]").click();

        // admin mengakses laman admin/employee
        cy.visit("admin/employee");

        // admin klik tombol input employee
        cy.get("[data-id=btn-input-emp").click();

        // admin redirected to admin/employee/create
        // admin fill the fields
        cy.get("[data-id=name-field]").type("Nama for testing", {
            force: true,
        });
        cy.get("[data-id=email-field]").type("testingggg@mail.com", {
            force: true,
        });
        cy.get("[data-id=password-field").type("1234567890", { force: true });
        cy.get("[data-id=role-select").select("Kasir");
        cy.get("[data-id=date-field]").type("2022-09-30");
        cy.get("[data-id=address-field]").type("Address testing", {
            force: true,
        });
        cy.get("[data-id=phone-field]").type("123456", { force: true });
        cy.get("[data-id=gender-select]").select("Male");
        cy.get("[data-id=btn-submit]").click();

        cy.get("[data-id=list-errors]").contains(
            "li",
            "The phone must be at least 10 characters."
        );
    });

    it("phone more than fifteen characters", () => {
        // admin melakukan login
        cy.visit("/login");

        cy.get("[data-id=field-email]").type("admin@mail.com");
        cy.get("[data-id=field-password]").type("12345678");
        cy.get("[data-id=btn-signin]").click();

        // admin mengakses laman admin/employee
        cy.visit("admin/employee");

        // admin klik tombol input employee
        cy.get("[data-id=btn-input-emp").click();

        // admin redirected to admin/employee/create
        // admin fill the fields
        cy.get("[data-id=name-field]").type("Nama for testing", {
            force: true,
        });
        cy.get("[data-id=email-field]").type("testingggg@mail.com", {
            force: true,
        });
        cy.get("[data-id=password-field").type("1234567890", { force: true });
        cy.get("[data-id=role-select").select("Kasir");
        cy.get("[data-id=date-field]").type("2022-09-30");
        cy.get("[data-id=address-field]").type("Address for testing", {
            force: true,
        });
        cy.get("[data-id=phone-field]").type("12345678909999090909", {
            force: true,
        });
        cy.get("[data-id=gender-select]").select("Male");
        cy.get("[data-id=btn-submit]").click();

        cy.get("[data-id=list-errors]").contains(
            "li",
            "The phone must not be greater than 15 characters."
        );
    });
});
