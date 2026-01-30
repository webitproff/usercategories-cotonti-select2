
# User Categories Plugin for Cotonti

User Categories is a plugin for Cotonti that allows users to select **specializations, skills, and professional activity areas** in which they work on a freelance marketplace or as sellers on a trading platform.

The plugin is designed to improve user profile quality and to provide **fast and convenient searching of users by categories**.

## [DEMONSTRATION](https://abuyfile.com/contractors/)

![usercategories](https://github.com/user-attachments/assets/ceaae335-bd80-4261-b088-0a4411caa7c7)
---

## Features

- Hierarchical user categories
- User specialization selection in profile
- Category-based user search and filtering
- Visual category badges in user lists
- Fully administrator-managed category structure
- Ready-to-use templates (Bootstrap 5.3)
- SELECT2 integration

---

## Main Purpose

The primary goal of the **User Categories** plugin is to **separate users by specializations** and make them easily discoverable through category-based search.

- Categories are created and managed by the **administrator**
- Users can only **select categories**, not edit them
- Selected categories are used:
  - in the user profile
  - in the users list
  - in search and filters

---

## Plugin Information

| Parameter | Value |
|---------|------|
| CMS | Cotonti 0.9.26 |
| PHP | 8.4+ |
| MySQL | 8.0 |
| Plugin Version | 3.6.27 |
| Release Date | January 30, 2026 |
| Adaptation | webitproff |
| Repository | [github](https://github.com/webitproff/usercategories-cotonti-select2) |

---

## Compatibility

- Can be installed immediately after Cotonti installation
- Works with the default **nemesis** theme
- Tested and adapted with:
  - **2waydeal** theme
  - **abuyfile.com** website

---

## ⚠️ Warnings and Requirements

### Important Notes

1. **Clean installation only**
   - Updating over older plugin versions was **not tested**
   - Results of such updates are unpredictable

2. **If you are unsure**
   - Install on a **local environment first**
   - Or make a full backup of your live website

3. **System requirements**
   - Cotonti `0.9.26`
   - PHP `8.4+`
   - MySQL `8.0`

---

## Installation (From Scratch)

This guide describes installation using the **nemesis** base theme.  
When using a custom theme, carefully check for duplicated files.

---

### 1. Upload Plugin Files

1. Download and extract the plugin archive
2. Locate the `usercategories` folder
3. Upload it to:

```
/plugins
````

> Make sure no files are lost during upload.

---

### 2. Install via Admin Panel

Navigate to:

```
Site Management → Extensions → User Categories
```

Click **Install**.

---

### 3. Category Structure

After installation, go to:

```
Site Management → Extensions → User Categories → Structure
```

* 58 sample categories are created by default
* You can edit, add, or delete categories at any time

#### Important

Clicking **Open** on a category will return a `404` error.
This is expected behavior.

Incorrect:

```
index.php?e=usercategories&c=websites
```

Correct:

```
index.php?e=users&cat=websites
```

---

## Integration

All integration files are located in the `customtools` directory.

---

## 1. Enable Custom Functions

### 1.1 `cot_load_structure_custom()`

* Copy `functions.custom.php` from:

```
/system
```

* Upload it to:

```
/system
```

If the file already exists, ensure it contains the
`cot_load_structure_custom()` function.

---

### 1.2 Enable Custom Functions in Config

Edit the file:

```
/datas/config.php
```

Change:

```
$cfg['customfuncs'] = false;
```

To:

```
$cfg['customfuncs'] = true;
```

This enables support for nested categories.

---

## 2. SELECT2 Integration

### 2.1 Theme Resource Loader

Replace the file:

```
themes/nemesis/nemesis.rc.php
```

with the version provided in `customtools`.

---

### 2.2 Styles

Append the contents of:

```
themes/nemesis/css/add_to_default.css
```

to the end of:

```
themes/nemesis/css/default.css
```

---

### 2.3 Scripts

Append the contents of:

```
themes/nemesis/js/js.js
```

to the end of your main `js.js`.

---

### 2.4 Copy Templates

Copy the following directories **as-is**:

```
inc
modules
plugins
```

into:

```
themes/nemesis/
```

✅ Installation and integration complete.

---

## Verification

### User Profile

```
index.php?e=users&m=profile
```

* Category checkboxes will be available
* Select categories and save profile

---

### Users List

```
index.php?e=users
```

* Category badges appear in user cards
* Parent categories are displayed

---

### Category Search

* Search input at the top of the page
* Category dropdown filter
* Search users within selected category

---

### Categories Menu

Click **Categories** in the top-left corner to open the full category tree.

---

## Templates

### Users Templates

```
customtools/themes/nemesis/modules/users
```

* Fully working templates
* Built with **Bootstrap 5.3**

#### User Groups Example

If you create a user group:

* Name: `Sellers`
* Alias: `sellers`

Copy:

```
users.tpl → users.sellers.tpl
```

---

### Plugin Templates

```
customtools/themes/nemesis/plugins/usercategories
```

* Ready-to-use plugin templates
* Fully customizable

---

## Template Integration Examples

### users.tpl

#### Selected Category Title

```
<!-- IF {PHP|cot_plugin_active('usercategories')} AND {USERS_CHOSEN_CATEGORY} -->
{USERS_CHOSEN_CATEGORY}
<!-- ENDIF -->
```

#### Category Tree

```
<!-- IF {PHP|cot_plugin_active('usercategories')} -->
{USERCATEGORIES_CATALOG}
<!-- ENDIF -->
```

#### Category Search Field

```
<!-- IF {PHP|cot_plugin_active('usercategories')} -->
<div class="row align-items-center">
  <label class="col-12 col-sm-3 mb-2 mb-sm-0">{PHP.L.Category}:</label>
  <div class="col-12 col-sm-9">{USERCATEGORIES_SEARCH_CAT}</div>
</div>
<!-- ENDIF -->
```

#### User Categories in List

```
<!-- IF {PHP|cot_plugin_active('usercategories')} AND {USERS_ROW_CATS} -->
<p class="mb-0">
  {USERS_ROW_CATS|cot_usercategories_tree($this, '', 'listlev1')}
</p>
<!-- ENDIF -->
```

---

### users.profile.tpl

```
<!-- IF {PHP|cot_plugins_active('usercategories')} -->
<!-- IF {USERS_PROFILE_CAT} -->
<div class="row mb-3">
  <label class="col-sm-3 col-form-label fw-semibold">
    {PHP.L.usercategories_specializations}:
  </label>
  <div class="col-sm-9">
    <div class="operation-checkboxes">
      <div class="operation-checkboxes-list">
        {USERS_PROFILE_CAT}
      </div>
    </div>
  </div>
</div>
<!-- ENDIF -->
<!-- ENDIF -->
```

---

### users.edit.tpl

```
<!-- IF {PHP|cot_plugins_active('usercategories')} -->
<!-- IF {USERS_EDIT_CAT} -->
<div class="row mb-3">
  <label class="col-sm-3 col-form-label fw-semibold">
    {PHP.L.usercategories_specializations}:
  </label>
  <div class="col-sm-9">
    <div class="operation-checkboxes">
      <div class="operation-checkboxes-list">
        {USERS_EDIT_CAT}
      </div>
    </div>
  </div>
</div>
<!-- ENDIF -->
<!-- ENDIF -->
```

---

### users.details.tpl

```
<!-- IF {PHP|cot_plugins_active('usercategories')} AND {USERS_DETAILS_CATS} -->
<p class="mb-0">
  {USERS_DETAILS_CATS|cot_usercategories_tree($this, '', 'listlev1')}
</p>
<!-- ENDIF -->
```

---

## License & Support

The **User Categories** plugin is published **free of charge**.

Support, bug reports, and usage questions should be posted in the
**User Categories** plugin support section on the Cotonti marketplace forum.

If something does not work on the first try when integrating into a custom theme — this is normal.
Post on the forum and help will be provided.

🍪 Cookies are welcome.




