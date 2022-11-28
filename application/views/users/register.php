        <div class="error"> <?=$this->session->flashdata('input_erros');?> </div>

        <h1>Register</h1>
        <form action="register/validate" method="POST">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
            First Name: <input type="text" name="first_name">
            Last names: <input type="text" name="last_name">
            Email address: <input type="text" name="email">
            Password: <input type="password" name="password">
            Confirm Password: <input type="password" name="confirm_password">

            <input type="submit" value="Register">
            <a href="signin"> Already have an account? Log in</a>
        </form>

    </body>
</html>