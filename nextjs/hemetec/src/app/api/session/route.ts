// nextjs/hemetec/src/app/api/session/route.ts
import { NextResponse } from "next/server";
 
// GET /api/session
export async function GET() {
  // Aqui você pode integrar com PHP via fetch ou simular sessão
  // Exemplo simples de simulação de sessão
  const sessionActive = true; // muda pra false se não tiver sessão
 
  if (!sessionActive) {
    return NextResponse.json(null);
  }
 
  const sessionData = {
    nome: "Lucas",
    email: "lucas@email.com",
    idAdm: 1,
  };
 
  return NextResponse.json(sessionData);
}
 