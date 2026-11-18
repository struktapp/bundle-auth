# Strukt Auth Bundle

Authentication, users, roles, permissions, and route protection for Strukt
applications.

## Identity

| Property | Value |
| --- | --- |
| Composer package | `strukt/bundle-auth` |
| Bundle class | `Strukt\Bundle\BundleAuth` |
| Bundle name | `bundle-auth` |
| Command name | `Auth` (`reset:password`) |
| Modules | `AuthModule` |
| Module class | `{{app}}\AuthModule\{{app}}AuthModule` |
| Requires | `core` |

## Contents

```text
app/src/App/...                     portable module and model templates
lib/App/Command/ResetPassword.php   reset:password console command
lib/App/Provider/...                application provider wiring
src/Strukt/Bundle/BundleAuth.php
```

The application files use the `{{app}}` placeholder and the stable
`app/src/App` layout. At install time, replace `{{app}}` with the target
application name, map `app/src/App/...` to `app/src/<App>/...`, and write
`.sgf` files as `.php`.

The descriptor manifest `files` array lists these portable payload files, and
its `modules` array lists the modules included in the bundle. Non-application
files keep their paths, but references to the source application namespace are
exported as `{{app}}` and resolved by `bundle:publish`.

## Password reset

The bundle includes an administrator password reset form and route:

```text
POST /user/{id:int}/reset-password
```

The route is guarded by `@Auth()` and `@Permission(user.update)`. It accepts
`password` and `password_confirmation`, both required, with the password at
least eight characters and the confirmation matching.

The same reset is available from the console after enabling the command in
`cfg/cmd.ini`:

```ini
[bundle-auth]
title = Bundle Auth
cmd[] = reset:password
```

```sh
./strukt reset:password admin@strukt.test
```

The command prompts for the email when omitted, then reads the new password and
confirmation without echoing them.

## Registration

Make the descriptor autoloadable, then register it in `cfg/repo.ini`:

```ini
auth = BundleAuth
```

Rebuild the application configuration cache:

```sh
./strukt cache:reset
./strukt bundle:ls
./strukt bundle:info auth
```
