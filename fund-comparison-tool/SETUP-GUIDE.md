# Nantis Flow-Through Fund Comparison Tool - Setup Guide

This guide will walk you through every single step to get the fund comparison
table working on your WordPress/Elementor website at nantis.ca.

**No coding knowledge needed.** Just follow the steps below.

---

## OVERVIEW - What You're Setting Up

You are connecting 3 things:

```
Excel Spreadsheet (your data) --> Widget Code --> Your WordPress Page
```

- **Excel / CSV file** = Where you type in fund data
- **Widget Code** = The HTML files (already built for you)
- **WordPress Pages** = Where visitors see the table

**You have 2 widget files:**
- `fund-comparison-widget.html` — **English** version (for www.nantis.ca)
- `fund-comparison-widget-fr.html` — **French** version (for www.nantis.ca/fr)

Both read from the **same spreadsheet** (same data, same CSV URL). The French
widget just shows French column headers, labels, and disclaimer text.

**Toggle Filters:**
- **Class A / Class F** — Switches which NAV values are displayed (different fee structures)
- **National / Quebec** — Filters funds by category
- **Nantis always appears** in both categories since it has a single class

---

## YOUR SPREADSHEET COLUMNS

The spreadsheet now has extra columns to support Class A/F and National/Quebec toggles:

| Column Header | What to Enter | Example |
|---------------|---------------|---------|
| Fund Name | Name of the flow-through fund | ABC Flow-Through 2024 LP |
| Category | **National**, **Quebec**, or **Both** | National |
| % of NAV (A) | Class A NAV as a percentage of starting NAV | 108.30 |
| NAV $ (A) | Class A current dollar value | 10830.00 |
| % of NAV (F) | Class F NAV as a percentage of starting NAV | 109.50 |
| NAV $ (F) | Class F current dollar value | 10950.00 |
| Inception Date | When the fund started (YYYY-MM-DD) | 2024-02-15 |
| Redemption Date | When the fund redeems (after inception) | 2026-02-15 |
| Liquidity Type | How you get paid out: **Cash** or **Mutual Fund Shares** | Cash |
| Is Nantis | **Yes** or **No** — Nantis rows always appear & get highlighted | Yes |

**IMPORTANT:**
- Enter numbers WITHOUT % or $ signs. Just the number (e.g., `112.45` not `112.45%`).
- For **Nantis**: Set `Category` to `Both`, `Is Nantis` to `Yes`, and use the **same values** for both (A) and (F) columns (since Nantis has no separate class).
- For funds in **both** National and Quebec categories, set `Category` to `Both`.

A template file `spreadsheet-template.csv` is included — you can import it
into Excel or Google Sheets to get started quickly.

---

## STEP 1: Set Up Your Data (Pick ONE Option)

### Option A: Excel on your computer (Simplest)

1. Open `spreadsheet-template.csv` in Excel
2. Replace the example data with your real fund data
3. Save As > **CSV (Comma delimited) (*.csv)**
4. Upload the CSV file to WordPress:
   - WordPress Dashboard > **Media** > **Add New** > Upload the file
   - After uploading, click on the file and **copy the URL**
   - It will look like: `https://www.nantis.ca/wp-content/uploads/2026/03/fund-data.csv`
5. When you update data: edit in Excel, re-save as CSV, re-upload to WordPress

### Option B: Excel Online (OneDrive) — Auto-updates

1. Go to https://onedrive.live.com and sign in
2. Click **+ New** > **Excel workbook**
3. Name it **Nantis Fund Data**
4. Set up headers in Row 1 (see column table above)
5. Enter your data starting from Row 2
6. To get the URL: File > Save As > Download a Copy as CSV, then upload to WordPress Media (same as Option A step 4)
7. Or use the embed/download link method (more advanced — ask if you need help)

### Option C: Google Sheets — Auto-updates

1. Go to https://sheets.google.com
2. Create a new spreadsheet named **Nantis Fund Data**
3. Set up headers and data (same columns as above)
4. **File** > **Share** > **Publish to the web**
5. Choose **Comma-separated values (.csv)** and click **Publish**
6. Copy the link

---

## STEP 2: Add the URL to Both Widget Files

You need to do this for **both** the English and French widget files.

### For the English version:
1. Open `fund-comparison-widget.html` in Notepad (or any text editor)
2. Find this line near the top:
   ```
   const DATA_CSV_URL = 'YOUR_SPREADSHEET_CSV_URL_HERE';
   ```
3. Replace `YOUR_SPREADSHEET_CSV_URL_HERE` with your CSV URL
4. Save the file

### For the French version:
1. Open `fund-comparison-widget-fr.html` in Notepad
2. Find the same line and replace the URL (use the **same URL** as the English one)
3. Save the file

**Both widgets read from the same spreadsheet.** You only maintain one set of data.

---

## STEP 3: Add the English Widget to nantis.ca

1. Go to `https://www.nantis.ca/wp-admin` and log in
2. Go to **Pages** > find your English comparison page (or create a new one)
3. Click **Edit with Elementor**
4. Search for the **"Custom HTML"** widget in the left panel
5. Drag it where you want the table
6. Open `fund-comparison-widget.html` in Notepad, Select All (Ctrl+A), Copy (Ctrl+C)
7. Paste into the Elementor HTML Code text area
8. Click **Update** to save

---

## STEP 4: Add the French Widget to nantis.ca/fr

1. In WordPress, go to **Pages** > find your French comparison page (or create one under /fr)
2. Click **Edit with Elementor**
3. Add a **"Custom HTML"** widget
4. Open `fund-comparison-widget-fr.html` in Notepad, Select All, Copy
5. Paste into the HTML Code text area
6. Click **Update**

**Note:** If you're using a multilingual plugin like WPML or Polylang, the French
page should already be set up as the translation of the English page. Just add
the French widget code to it.

---

## STEP 5: Updating Your Data (Ongoing)

### If using CSV upload to WordPress (Option A):
1. Edit your Excel file
2. Save As CSV
3. Go to WordPress Dashboard > Media
4. Upload the new CSV (same filename replaces the old one)
5. The table updates on **both** English and French pages automatically

### If using Google Sheets (Option C):
1. Edit the Google Sheet
2. Done — both pages update automatically within minutes

---

## HOW THE TOGGLES WORK

The table has **two toggle filters** at the top:

### Class A / Class F Toggle
- **Class A** = Shows `% of NAV (A)` and `NAV $ (A)` columns from your spreadsheet
- **Class F** = Shows `% of NAV (F)` and `NAV $ (F)` columns from your spreadsheet
- Different classes have different fee structures, so NAV values differ
- **Nantis** shows the same values for both (single class — put identical values in A and F columns)
- Ranking recalculates based on the selected class

### National / Quebec Toggle
- **National** = Shows funds with Category = "National" or "Both"
- **Quebec** = Shows funds with Category = "Quebec" or "Both"
- **Nantis always appears** in both views (flagged by `Is Nantis = Yes`)
- Ranking recalculates based on the visible funds

### Example Scenarios
- Someone selects **Class F + Quebec**: They see Nantis plus all Quebec-category funds, ranked by their Class F NAV values
- Someone selects **Class A + National**: They see Nantis plus all National-category funds, ranked by their Class A NAV values

---

## WHAT THE TABLE SHOWS

| Column | English Label | French Label |
|--------|---------------|--------------|
| Rank | Rank | Rang |
| Fund Name | Fund Name | Nom du fonds |
| % of NAV | % of NAV | % de la VAN |
| NAV ($) | NAV ($) | VAN ($) |
| Inception Date | Inception Date | Date de création |
| Redemption Date | Redemption Date | Date de rachat |
| Liquidity Type | Liquidity Type | Type de liquidité |

**Note:** The Nantis row is highlighted with a teal left border so it stands out.

**Disclaimer shown at the bottom of both versions:**
- English: "The comparison is made strictly in relation to the NAV (now) to the starting NAV and does not include the tax deductions mix (CMETC, METC) that could have a significant effect on overall investment returns."
- French: "La comparaison est effectuée strictement en fonction de la VAN (actuelle) par rapport à la VAN de départ et n'inclut pas la combinaison des déductions fiscales (CMETC, METC) qui pourrait avoir un effet significatif sur le rendement global de l'investissement."

---

## FEATURES

- **Toggle filters:** Switch between Class A/F and National/Quebec categories
- **Nantis always visible:** Highlighted row, always shown regardless of category filter
- **Auto-ranking:** Funds ranked by % of NAV (highest = #1), recalculates per toggle
- **Sortable:** Click any column header to sort
- **Search:** Type to find specific funds
- **Color coding:** Positive % green, negative % red
- **Gold/Silver/Bronze:** Top 3 get special badges
- **Mobile friendly:** Scrolls horizontally on phones
- **Auto-refresh:** Data refreshes every 5 minutes
- **Bilingual:** Same data, two languages

---

## TROUBLESHOOTING

### Table shows "demo data"
- Make sure you replaced `YOUR_SPREADSHEET_CSV_URL_HERE` with your actual URL

### Numbers look wrong
- Enter numbers WITHOUT % or $ signs in the spreadsheet

### Columns missing or empty
- Check that column headers match exactly: `Fund Name`, `Category`, `% of NAV (A)`, `NAV $ (A)`, `% of NAV (F)`, `NAV $ (F)`, `Inception Date`, `Redemption Date`, `Liquidity Type`, `Is Nantis`

### Nantis doesn't appear in both categories
- Make sure the Nantis row has `Is Nantis` set to `Yes` and `Category` set to `Both`

### Class A and Class F show the same values for Nantis
- This is correct! Nantis has a single class, so enter the same values in both (A) and (F) columns

---

## NEED HELP?

If anything is unclear or you need changes, just ask!
