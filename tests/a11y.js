import axe from 'axe-core';
import { JSDOM } from 'jsdom';

const baseUrl = process.argv[2] || 'http://localhost:8000';
const paths = ['/', '/login', '/register'];

async function check(url) {
  const res = await fetch(url);
  const html = await res.text();
  const dom = new JSDOM(html, { url });
  const results = await axe.run(dom.window.document);
  if (results.violations.length) {
    console.log(`Violations on ${url}`);
    console.log(JSON.stringify(results.violations, null, 2));
  }
  return results.violations.length;
}

let total = 0;
for (const path of paths) {
  total += await check(`${baseUrl}${path}`);
}

const score = Math.max(0, 100 - total);
const threshold = parseFloat(process.env.A11Y_THRESHOLD || '95');
console.log(`Accessibility score: ${score}`);
if (score < threshold) {
  console.error(`Accessibility score ${score} below threshold ${threshold}`);
  process.exit(1);
}
