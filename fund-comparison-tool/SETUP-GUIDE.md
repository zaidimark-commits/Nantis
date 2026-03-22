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

---

## YOUR SPREADSHEET COLUMNS

The table has been customized for flow-through fund comparison:

| Column Header | What to Enter | Example |
|---------------|---------------|---------|
| Fund Name | Name of the flow-through fund | ABC Flow-Through 2024 LP |
| % of NAV | Current NAV as a percentage of starting NAV | 112.45 |
| NAV ($) | Current dollar value | 11245.00 |
| Inception Date | When the fund started (YYYY-MM-DD) | 2024-02-15 |
| Redemption Date | When the fund redeems (after inception) | 2026-02-15 |
| Liquidity Type | How you get paid out: **Cash** or **Mutual Fund Shares** | Cash |

**IMPORTANT:** Enter numbers WITHOUT % or $ signs. Just the number (e.g., `112.45` not `112.45%`).

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
4. Set up headers in Row 1: `Fund Name`, `% of NAV`, `NAV ($)`, `Inception Date`, `Redemption Date`, `Liquidity Type`
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

**Disclaimer shown at the bottom of both versions:**
- English: "The comparison is made strictly in relation to the NAV (now) to the starting NAV and does not include the tax deductions mix (CMETC, METC) that could have a significant effect on overall investment returns."
- French: "La comparaison est effectuée strictement en fonction de la VAN (actuelle) par rapport à la VAN de départ et n'inclut pas la combinaison des déductions fiscales (CMETC, METC) qui pourrait avoir un effet significatif sur le rendement global de l'investissement."

---

## FEATURES

- **Auto-ranking:** Funds ranked by % of NAV (highest = #1)
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
- Check that column headers match exactly: `Fund Name`, `% of NAV`, `NAV ($)`, `Inception Date`, `Redemption Date`, `Liquidity Type`

---

## NEED HELP?

If anything is unclear or you need changes, just ask!
