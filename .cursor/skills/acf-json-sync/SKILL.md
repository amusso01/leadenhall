---
name: acf-json-sync
description: Edit and sync ACF field group JSON (acf-json). Use when adding or changing ACF fields in JSON, when sync is not appearing, or when working with acf-json folder and block field groups.
---

# ACF JSON – editing and sync

Use this skill when creating or editing ACF field group JSON files (e.g. in `acf-json/`) so that the agent follows project conventions and sync works.

## 1. Human-readable JSON

**Always write ACF JSON in expanded form**, not as a single line.

- Use **4-space indentation** for nesting.
- Put each object key and array element on its own line where it stays readable.
- ACF accepts both minified and pretty-printed JSON; readable files are easier to diff and review.

Example of the right style:

```json
{
    "key": "group_abc123",
    "title": "My Block",
    "fields": [
        {
            "key": "field_xyz",
            "label": "Title",
            "name": "title",
            "type": "text"
        }
    ],
    "modified": 1771519580
}
```

## 2. Bump `modified` to trigger sync

ACF shows **"Sync available"** only when the JSON is considered **newer** than the field group in the database.

- **`modified`** in the JSON is a **Unix timestamp** (seconds since 1 January 1970 00:00:00 UTC).
- ACF compares this value to the field group's `post_modified` in the database.
- If **JSON `modified` > DB `post_modified`**, sync is offered.

**Rule: whenever you change an ACF JSON file, set `modified` to a value strictly greater than the actual current date/time.** The timestamp must be 100% greater than "now" (e.g. run `date +%s` in the terminal and use that value, or add 1 to it). If `modified` is less than or equal to the DB's `post_modified`, the UI will not show "Sync available" and the DB will not update from the JSON. Do not guess a date—use the current Unix timestamp (or current + 1) so the JSON is always newer than the database.

## 3. Other conventions

- **Save/load path**: The theme must set `acf/settings/save_json` and `acf/settings/load_json` to the theme's `acf-json` folder (e.g. `get_template_directory() . '/acf-json'`). Otherwise ACF uses the default path and theme JSON is ignored.
- **Field type IDs**: Use the official slugs from the docs (e.g. `text`, `textarea`, `color_picker`, `tab`, `image`, `wysiwyg`, `repeater`). Wrong or custom type strings can break sync or field behaviour.
- **Color Picker (ACF 6)**: Use **`enable_transparency`** (0 or 1), not `enable_opacity`, in the JSON.
- **Block location**: Block field groups use `"param": "block"` and `"value": "acf/fd-block-name"` in the `location` array.

## 4. Documentation links

Future agents (and you) can use these for exact behaviour and field structures:

- **ACF Resources (overview)**: https://www.advancedcustomfields.com/resources/
- **Local JSON** (save/load paths, folder): https://www.advancedcustomfields.com/resources/local-json/
- **Synchronized JSON** (when sync is offered, `modified`): https://www.advancedcustomfields.com/resources/synchronized-json/
- **Field types** (type IDs and settings):
  - Text: https://www.advancedcustomfields.com/resources/text/
  - Text Area: https://www.advancedcustomfields.com/resources/textarea/
  - Color Picker: https://www.advancedcustomfields.com/resources/color-picker/
  - Tab: part of Layout fields in the Resources index
- **Register fields via PHP** (can help infer JSON structure): https://www.advancedcustomfields.com/resources/register-fields-via-php/

When in doubt, compare with an existing JSON file in the project that ACF has already written (e.g. one that was saved from the field group editor), or check the relevant field type page in the ACF docs.
