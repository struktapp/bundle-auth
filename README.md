# Strukt AuthModule Bundle

Authentication, users, roles, permissions, and route protection for Strukt
applications.

## Identity

| Property | Value |
| --- | --- |
| Composer package | `strukt/bundle-auth` |
| Bundle class | `Strukt\Bundle\BundleAuthModule` |
| Bundle name | `bundle-auth` |
| Command name | `null` (no CLI commands) |
| Modules | `AuthModule` |
| Module class | `{{app}}\AuthModule\{{app}}AuthModule` |
| Requires | `core` |

## Contents

```text
app/src/App/...                     portable module and model templates
lib/App/Provider/...                application provider wiring
src/Strukt/Bundle/BundleAuthModule.php
```

The application files use the `{{app}}` placeholder and the stable
`app/src/App` layout. At install time, replace `{{app}}` with the target
application name, map `app/src/App/...` to `app/src/<App>/...`, and write
`.sgf` files as `.php`.

The descriptor manifest `files` array lists these portable payload files, and
its `modules` array lists the modules included in the bundle. Non-application
provider files are copied unchanged and still use the original application
namespace. Review them when installing into an application with a different
name.

## Registration

Make the descriptor autoloadable, then register it in `cfg/repo.ini`:

```ini
auth_module = BundleAuthModule
```

Rebuild the application configuration cache:

```sh
./strukt cache:reset
./strukt bundle:ls
./strukt bundle:info auth_module
```
