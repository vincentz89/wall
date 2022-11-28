        <div class="error"> <?=$this->session->flashdata('input_erros');?> </div>

        <h1>Login</h1>
        <form action="signin/validate" method="POST">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
            Email address: <input type="text" name="email">
            Password: <input type="password" name="password">

            <input type="submit" value="Signin">
            <a href="register"> Don't have an account? Click here to Register</a>
        </form>

    </body>
</html>